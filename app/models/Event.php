<?php 
require_once "app/config/database.php";

class Event{
    private $db;

    public function __construct(){
        $this->db  = (new Database())->connect();
    }

    public function getAllEvent(){
        $result = $this->db->query("SELECT * FROM `events`");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTopEvent(){
        $result = $this->db->query("SELECT events.title, events.description, events.event_date, events.current_participants, categories.name FROM events INNER JOIN categories ON events.category_id = categories.id ORDER BY 'current_participants' DESC LIMIT 3;");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function AddEvent($user, $category, $title, $deskripsi, $date, $time_start, $time_end, $location, $max_peserta, $price, $status){
        $query = "INSERT INTO events (user_id, category_id, title, description, event_date, event_time, event_end_time, location, max_participants, price, status) VALUES ('$user','$category', '$title', '$deskripsi','$date', '$time_start', '$time_end','$location', '$max_peserta','$price', '$status') ";
        return $this->db->query($query);
    }

    public function EditEvent($category, $title, $deskripsi, $date, $time_start, $time_end, $location, $max_peserta, $price, $status){
        $query = "UPDATE events  set  category_id = '$category', title = '$title',  description = '$deskripsi', event_date = '$date', event_time = '$time_start', event_end_time = '$time_end', location = '$location', max_participants = '$max_peserta', price = '$price', status = '$status' ";
        return $this->db->query($query);
    }
}



?>