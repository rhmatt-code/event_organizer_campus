<?php 

require_once "models/Event.php";


class EventController{

    

    public function home(){
        $eventModel = new Event();
        $data = $eventModel->getAllEvent();
        $top = $eventModel->getTopEvent();

        $editData = null;
        if(isset($_GET['edit'])){
            $editData = $eventModel->getById($_GET['edit']);
        }
        
        require "views/root/indexUser.php";
    }

    public function addEvent(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $user = $_SESSION['user']['id'];
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

            $model = new Event();
            $insert = $model->AddEvent($user, $category, $title, $deskripsi, $date, $time_start, $time_end, $location, $max_peserta, $price, $status);

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