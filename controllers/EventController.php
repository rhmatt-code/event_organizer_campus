<?php 

require_once "models/Event.php";
require_once "models/Notification.php";
require_once "models/Auth.php";



class EventController{


    public function home(){
        $eventModel = new Event();
        $users = new Auth();
        $data = $eventModel->getAllEvent();
        $top = $eventModel->getTopEvent();
        $list = $users->getAllUsers();
        $recommendation = $eventModel->getRecommendation();


        if(isset($_SESSION['id'])){
            $userId = $_SESSION['id'];
        }else{
            $userId = 0;
        };

        $myEvents = $eventModel->getUserRegisteredEvents($userId);   
            
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

     public function downloadCSV(){
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename=laporan_analitik_event.csv');

        $output = fopen("php://output", "w");
        fputcsv($output, ['Jenis Event', 'Total Peserta']);
        $service = new Event();
        $data = $service->getTopEvent();
        foreach ($data as $row) {
            fputcsv($output, [
                $row['category_name'],
                $row['total_peserta'],
            ]);
        }
        fclose($output);
        exit;
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
                'max_peserta' => $_POST['max'],
                'price' => $_POST['price'],
                'deskripsi' => $_POST['deskripsi'],
            ]; 

            
            $model = new Event();
            $insert = $model->AddEvent($eventData);

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

        if ($event['google_calender_event_id']) {
        $client = GoogleClientApp::getClient();
        $client->setAccessToken($_SESSION['google_token']);

        if ($client->isAccessTokenExpired()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        }

        $service = new Google_Service_Calendar($client);
        $service->events->delete('primary', $event['google_event_id']);
    }
        $delete = $model->deleteEvent($id);
        header("Location: index.php");
    }

    public function daftarEvent(){
        $model = new Event();
        $notif = new NotificationModel();
        $user = new Auth();
        $userId = $_SESSION['id'];
        $eventId = $_POST['id'];
        $daftar = $model->daftarEvent($userId, $eventId);
        $row = $user->findById($userId);
        
        $notif = $notif->createNotification($userId, $eventId, $row['email']);
        header("Location: index.php");
        
    }

    public function peserta()
    {
        

        $eventId = $_GET['event_id'] ?? null;
        if (!$eventId) {
            http_response_code(400);
            exit;
        }

        $event = new Event();
        $participants = $event->getByEvent((int)$eventId);

        // render PARTIAL VIEW
        require "views/root/components/_list_pendaftar.php";
    }


    
}


?>