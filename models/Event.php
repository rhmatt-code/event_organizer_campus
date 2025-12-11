<?php 
require_once "config/database.php";
require_once 'Auth.php';
use Google\Client;
use Google\Service\Calendar;


class Event{
    private $db;


    public function __construct(){
        $this->db  = (new Database())->connect();
        $this->auth = new Auth();
    }

    public function getAllEvent(){
        $result = $this->db->query("SELECT events.id AS id_event, events.*, categories.* FROM events INNER JOIN categories ON events.category_id = categories.id ORDER BY `category_id` DESC;");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserRegisteredEvents($userId) {
        $sql = "SELECT e.* FROM events e JOIN event_registrations r ON e.id = r.event_id WHERE r.user_id = ?;";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result();
    }

     public function getById($id){
        $sql = "SELECT * FROM events WHERE id = $id LIMIT 1";
        return $this->db->query($sql)->fetch_assoc();
    }

    public function getTopEvent(){
        $result = $this->db->query("SELECT c.id AS category_id, c.name AS category_name, c.description, c.color AS color_name, COUNT(DISTINCT e.id) AS total_event, COUNT(r.id) AS total_peserta, SUM(e.max_participants) AS total_kapasitas FROM categories c LEFT JOIN events e ON e.category_id = c.id LEFT JOIN event_registrations r ON r.event_id = e.id GROUP BY c.id ORDER BY total_peserta DESC LIMIT 3;");
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
        $query = "INSERT INTO events (user_id, category_id, title, description, event_date, event_time, event_end_time, location, max_participants, price, status) VALUES (?,?,?,?,?,?,?,?,?,?,?) ";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$eventData['user'], $eventData['category'], $eventData['title'], $eventData['deskripsi'], $eventData['date'], $eventData['time_start'], $eventData['time_end'], $eventData['location'], $eventData['max_peserta'], $eventData['price'], $eventData['status']]);
        
        $eventId = $this->db->insert_id;

        $google = $this->googleService();

         $event = new Google\Service\Calendar\Event([
            'summary' => $eventData['title'],
            'location' => $eventData['location'],
            'description' => $eventData['deskripsi'],
            'start' => [
                'dateTime' => date('c', strtotime($eventData['time_start'])),
                'timeZone' => 'Asia/Jakarta',
            ],   
            'end' => [
                'dateTime' => date('c', strtotime($eventData['time_end'])),
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


    public function EditEvent($category, $title, $deskripsi, $date, $time_start, $time_end, $location, $max_peserta, $price, $status, $id){
        $query = "UPDATE events SET category_id=$category,title = '$title',  description = '$deskripsi', event_date = '$date', event_time = '$time_start', event_end_time = '$time_end', location = '$location', max_participants = '$max_peserta', price = '$price', status='$status' WHERE id = $id ";
        $query = $this->db->query($query);
        
        $stmt = $this->db->prepare("SELECT google_calendar_event_id FROM events WHERE id = ?");
        $stmt->execute([$id]);
        $stmt->bind_result($googleEventId);
        $stmt->fetch();
        $stmt->close();

        if ($googleEventId) {   
            $google = $this->googleService();
            $event = $google->events->get('primary', $googleEventId);
            $event->setSummary($title);
            $event->setLocation($location);
            $event->setDescription($deskripsi);
            $start = new Google\Service\Calendar\EventDateTime();
            $start->setDateTime(date('c', strtotime($time_start)));
            $start->setTimeZone('Asia/Jakarta');
            $event->setStart($start);
            $end = new Google\Service\Calendar\EventDateTime();
            $end->setDateTime(date('c', strtotime($time_end)));
            $end->setTimeZone('Asia/Jakarta');
            $event->setStart($end);

            $google->events->update('primary', $googleEventId, $event);
        }

        return true;
    }

    public function deleteEvent($id){

        $stmt = $this->db->prepare("SELECT google_calendar_event_id FROM events WHERE id=?");
        $stmt->execute([$id]);
        $stmt->bind_result($googleId);
        $stmt->fetch();
        $stmt->close();
        

        if ($googleId) {
            $google = $this->googleService();
            $google->events->delete('primary', $googleId);
        }


        $stmt = $this->db->prepare("DELETE FROM events WHERE id=?");
        $stmt->execute([$id]);

        return true;
    }
}



?>