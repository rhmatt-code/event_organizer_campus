<?php 

require_once "models/Event.php";



class EventController{

    

    public function home(){
        $eventModel = new Event();
        $users = new Auth();
        $data = $eventModel->getAllEvent();
        $top = $eventModel->getTopEvent();
        $list = $users->getAllUsers();

        $userId = isset($_SESSION['id']);
        $myEvents = $eventModel->getUserRegisteredEvents($userId);

        // Buat array id event yang user daftar
        $registeredEventIds = [];
        while ($row = $myEvents->fetch_assoc()) {
            $registeredEventIds[] = $row['id'];
        }

        
        $editData = null;
        if(isset($_GET['edit'])){
            $editData = $eventModel->getById($_GET['edit']);
        }
        
        require "views/root/indexUser.php";
    }

    

    public function addEvent(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $eventData = [
                'user' => $_SESSION['id'],
                'title' => $_POST['title'],
                'date' => $_POST['date'],
                'time_start' => $_POST['time_start'],
                'time_end' => $_POST['time_end'],
                'location' => $_POST['location'],
                'category' => $_POST['category'],
                'status' => $_POST['status'],
                'max_peserta' => $_POST['max'],
                'price' => $_POST['price'],
                'deskripsi' => $_POST['deskripsi'],
            ]; 

            
            $model = new Event();
            $insert = $model->AddEvent($eventData);
            $googleEventId = $model->createEventToGoogle($eventData);
            $model->attachGoogleEvent($insert, $googleEventId);

            header("Location: index.php");
        }
    }

    

    public function editEvent(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $title = $_POST['title'];
            $date = $_POST['date'];
            $time_start = $_POST['time_start'];
            $time_end = $_POST['time_end'];
            $location = $_POST['location'];
            $category = $_POST['category'];
            $status = $_POST['status'];
            $max_peserta = $_POST['max'];
            $price = $_POST['price'];
            $deskripsi = $_POST['deskripsi'];
            $id = $_POST['id'];

            $model = new Event();
            $insert = $model->editEvent($category, $title, $deskripsi, $date, $time_start, $time_end, $location, $max_peserta, $price, $status, $id);

            header("Location: index.php");
        }
    }

    public function deleteEvent($id){
        $model = new Event();
        $delete = $model->deleteEvent($id);
        header("Location: index.php");
    }

    
}


?>