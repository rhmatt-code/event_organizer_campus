<?php 
require_once __DIR__."/../config/database.php";
require_once 'Auth.php';
use Google\Client;
use Google\Service\Calendar;


class Event{
    private $db;
    private $auth;


    public function __construct(){
        $this->db  = (new Database())->connect();
        $this->auth = new Auth();
    }

    public function getAllEvent(){
        $result = $this->db->query("SELECT events.id AS id_event, events.*, events.description AS event_description, categories.*, users.name as user_name FROM events INNER JOIN categories ON events.category_id = categories.id JOIN users ON events.user_id = users.id ORDER BY `category_id` DESC;");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserRegisteredEvents($userId) {
        $sql = "SELECT e.* FROM events e JOIN event_registrations r ON e.id = r.event_id WHERE r.user_id = $userId;";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->get_result();
    }

     public function getById($id){
        $sql = "SELECT * FROM events WHERE id = $id LIMIT 1";
        return $this->db->query($sql)->fetch_assoc();
    }

    public function getTopEvent(){
        $result = $this->db->query("SELECT c.id AS category_id, c.name AS category_name, c.description, c.color AS color_name, COUNT(DISTINCT e.id) AS total_event, COUNT(r.id) AS total_peserta, SUM(e.max_participants) AS total_kapasitas FROM categories c LEFT JOIN events e ON e.category_id = c.id LEFT JOIN event_registrations r ON r.event_id = e.id GROUP BY c.id ORDER BY total_peserta DESC;");
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        foreach ($rows as $i => $row) {
            $percent = 0;
            if (!empty($row['total_kapasitas']) && $row['total_kapasitas'] > 0) {
                $percent = ($row['total_peserta'] / $row['total_kapasitas']) * 100;
            }
            $rows[$i]['percent'] = round($percent);
        }
        return $rows;
    

    }

    private function googleService()
    {
        $client = GoogleClientConfig::getClient();
        $token = $this->auth->getGoogleToken($_SESSION['id']);

        if (!$token) {
            die("Google not connected");
        }

        $client->setAccessToken(json_decode($token, true));

        if ($client->isAccessTokenExpired()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            $this->auth->saveGoogleToken($_SESSION['id'], json_encode($client->getAccessToken()));
        }

        return new Calendar($client);
    }

    public function AddEvent($eventData){
        $query = "INSERT INTO events (user_id, category_id, title, description, event_date, event_time, event_end_time, location, max_participants, price) VALUES (?,?,?,?,?,?,?,?,?,?) ";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$eventData['user'], $eventData['category'], $eventData['title'], $eventData['deskripsi'], $eventData['date'], $eventData['time_start'], $eventData['time_end'], $eventData['location'], $eventData['max_peserta'], $eventData['price']]);
        
        $eventId = $this->db->insert_id;

        $google = $this->googleService();
        $startTime = $eventData['date']. ' ' .$eventData['time_start'];
        $endTime = $eventData['date']. ' ' .$eventData['time_end'];
        
        $start = new DateTime($startTime, new DateTimeZone('Asia/Jakarta'));
        $end   = new DateTime($endTime,   new DateTimeZone('Asia/Jakarta'));

        $event = new Google\Service\Calendar\Event([
            'summary' => $eventData['title'],
            'location' => $eventData['location'],
            'description' => $eventData['deskripsi'],
            'start' => [
                'dateTime' => $start->format(DateTime::RFC3339),
                'timeZone' => 'Asia/Jakarta',
            ],   
            'end' => [
                'dateTime' => $end->format(DateTime::RFC3339),
                'timeZone' => 'Asia/Jakarta',
            ]

        ]);

        $googleEvent = $google->events->insert('primary', $event);

        $stmt = $this->db->prepare("UPDATE events SET google_calendar_event_id = ? WHERE id = ?");
        $stmt->execute([$googleEvent->getId(), $eventId]);

        return $eventId;
    }

    
    public function attachGoogleEvent($eventId, $googleId) {
        $query = $this->db->prepare("UPDATE events SET google_calendar_event_id=? WHERE id=?");
        $query->execute([$googleId, $eventId]);
    }


    public function EditEvent($category, $title, $deskripsi, $date, $time_start, $time_end, $location, $max_peserta, $price, $id){
        $query = "UPDATE events SET category_id=$category,title = '$title',  description = '$deskripsi', event_date = '$date', event_time = '$time_start', event_end_time = '$time_end', location = '$location', max_participants = '$max_peserta', price = '$price' WHERE id = $id ";
        $query = $this->db->query($query);
        
        $stmt = $this->db->prepare("SELECT google_calendar_event_id FROM events WHERE id = ?");
        $stmt->execute([$id]);
        $stmt->bind_result($event);
        $stmt->fetch();
        $stmt->close();
        
        $startTime = $date. ' ' .$time_start;
        $endTime = $date. ' ' .$time_end;
        
        $start = new DateTime($startTime, new DateTimeZone('Asia/Jakarta'));
        $end   = new DateTime($endTime,   new DateTimeZone('Asia/Jakarta'));

        if ($googleEventId) {   
            $google = $this->googleService();
            $event = $google->events->get('primary', $event);
            $event->setSummary($title);
            $event->setLocation($location);
            $event->setDescription($deskripsi);
            $start = new Google\Service\Calendar\EventDateTime();
            $start->setDateTime($start);
            $start->setTimeZone('Asia/Jakarta');
            $event->setStart($start);
            $end = new Google\Service\Calendar\EventDateTime();
            $end->setDateTime($end->format(DateTime::RFC3339));
            $end->setTimeZone('Asia/Jakarta');
            $event->setStart($end);

            $google->events->update('primary', $googleEventId, $event);
        }

        return true;
    }

    public function deleteEvent($id){
        $stmtGoogle = $this->db->prepare("SELECT google_calendar_event_id FROM events WHERE id=?");
        $stmtGoogle->execute([$id]);
        $stmtGoogle->bind_result($googleId);
        $stmtGoogle->fetch();
        $stmtGoogle->close();
        
        if (!empty($googleId)) {
           try {
            
            $google = $this->googleService();
            $google->events->delete('primary', $googleId);
            
            } catch (Google_Service_Exception $e) {
                $errorCode = $e->getCode();
                
                if ($errorCode == 404 || $errorCode == 410) {
                    error_log("Event $googleId sudah dihapus dari Google Calendar");
                }
                
                error_log("Error menghapus Google Calendar event: " . $e->getMessage());
                
                
            }
        }

        $stmt1 = $this->db->prepare("DELETE FROM notifications WHERE event_id = ?");
        $delete1 = $stmt1->execute([$id]);
        $stmt2 = $this->db->prepare("DELETE FROM events WHERE id = ?");
        $delete2 = $stmt2->execute([$id]);
        
        
        return ($stmtGoogle && $delete1 && $delete2);
    }

    public function daftarEvent($userId, $eventId){
        $stmt = $this->db->prepare("UPDATE events set current_participants = current_participants + 1 WHERE id = $eventId");
        $stmt->execute();
        
        $eventData = $this->getById((int)$eventId);

        $google = $this->googleService();
        $startTime = $eventData['event_date']. ' ' .$eventData['event_time'];
        $endTime = $eventData['event_date']. ' ' .$eventData['event_end_time'];
        
        $start = new DateTime($startTime, new DateTimeZone('Asia/Jakarta'));
        $end   = new DateTime($endTime,   new DateTimeZone('Asia/Jakarta'));

        $event = new Google\Service\Calendar\Event([
            'summary' => $eventData['title'],
            'location' => $eventData['location'],
            'description' => $eventData['description'],
            'start' => [
                'dateTime' => $start->format(DateTime::RFC3339),
                'timeZone' => 'Asia/Jakarta',
            ],   
            'end' => [
                'dateTime' => $end->format(DateTime::RFC3339),
                'timeZone' => 'Asia/Jakarta',
            ]

        ]);

        $googleEvent = $google->events->insert('primary', $event);

        $stmt = $this->db->prepare("INSERT INTO event_registrations (user_id, event_id) VALUES ('$userId', '$eventId')");
        $stmt->execute();
        
        return true;
    }
    
    public function getPendaftar($eventId) {
        $stmt = $this->db->prepare("SELECT * FROM list_pendaftars WHERE id = $eventId");
        $stmt->execute();
        return $stmt->get_result();
    }
    
    public function getRegisteredEvents(){
        $stmt = $this->db->query("SELECT id FROM event_registrations");
        
        return $stmt->fetch_all(MYSQLI_ASSOC);
    }

    public function getByEvent($eventId) {
        $stmt = $this->db->prepare("SELECT u.id, u.name, u.email, er.created_at, e.google_calendar_event_id FROM event_registrations er JOIN users u ON u.id = er.user_id JOIN events e ON e.id = er.event_id WHERE er.event_id = '$eventId'");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}



?>