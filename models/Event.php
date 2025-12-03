<?php 
require_once "config/database.php";
require_once 'Auth.php';
use Google\Client;
use Google\Service\Calendar;


class Event{
    private $db;

    private function getGoogleClient() {
        $client = new Client();
        $client->setAuthConfig(__DIR__ . '/../config/credentials.json');
        $client->setRedirectUri("http://localhost/fp-event_organizer_campus/index.php?page=callback");
        $client->addScope(Calendar::CALENDAR);
        $client->setAccessType('offline');
        return $client;
    }

    public function __construct(){
        $this->db  = (new Database())->connect();
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

    public function AddEvent($eventData){
        $query = "INSERT INTO events (user_id, category_id, title, description, event_date, event_time, event_end_time, location, max_participants, price, status) VALUES (?,?,?,?,?,?,?,?,?,?,?) ";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$eventData['user'], $eventData['category'], $eventData['title'], $eventData['deskripsi'], $eventData['date'], $eventData['time_start'], $eventData['time_end'], $eventData['location'], $eventData['max_peserta'], $eventData['price'], $eventData['status']]);
        
    }

    public function createEventToGoogle($eventData){
        $client = GoogleClientConfig::getClient();
        $auth = new Auth();

        $token = $auth->getGoogleToken($_SESSION['id']);
        $client = $this->getGoogleClient();
        $client->setAccessToken($token);

        if ($client->isAccessTokenExpired()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            $auth->saveGoogleToken($_SESSION['id'], json_encode($client->getAccessToken()));
        }

        
        $service = new Calendar($client);
        
        
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

        $calenderId = 'primary';
        $googleEvent = $service->events->insert($calenderId, $event);

        return $googleEvent->id;
    }
    
    public function attachGoogleEvent($eventId, $googleId) {
        $query = $this->db->prepare("UPDATE events SET google_calendar_event_id=? WHERE id=?");
        $query->execute([$googleId, $eventId]);
    }


    public function EditEvent($category, $title, $deskripsi, $date, $time_start, $time_end, $location, $max_peserta, $price, $status, $id){
        $query = "UPDATE events SET category_id=$category,title = '$title',  description = '$deskripsi', event_date = '$date', event_time = '$time_start', event_end_time = '$time_end', location = '$location', max_participants = '$max_peserta', price = '$price', status='$status' WHERE id = $id ";
        return $this->db->query($query);
    }

    public function deleteEvent($id){
        $query = "delete from events where id='$id'";
        return $this->db->query($query);
    }
}



?>