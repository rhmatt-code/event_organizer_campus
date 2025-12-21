<?php

session_start();

include __DIR__."/../controllers/EventController.php";
include __DIR__."/../controllers/AuthController.php";
include __DIR__."/../controllers/GoogleController.php";
require __DIR__.'/../config/bootstrap.php';



$page = $_GET['page'] ?? 'index';

$event = new EventController();
$auth = new AuthController();
$google = new GoogleCalendarController();

switch($page){

    case "index":
        $event->home();
    break;

    case "login":
        $auth->login();
    break;

    case "callback";
        $auth->callback();
    break;

    case "logout":
    if(isset($_SESSION['id'])){
        $auth->logout();
        $google->disconnect();
    }else{
        header("Location: index.php");
    }
    break;
    
    case "analytics_csv":
        $event->downloadCSV();
    break;

    case "addevent":
    if(isset($_SESSION['id'])){
        $event->addEvent();
    }else{
        header("Location: index.php");
    }    
    break;

    case "editevent":    
    if(isset($_SESSION['id'])){
        $event->editEvent();
    }else{
        header("Location: index.php");
    }    
    break;

    case "daftarEvent":    
    if(isset($_SESSION['id'])){
        $event->daftarEvent();
    }else{
        header("Location: index.php");
    }    
    break;

    case "peserta_event":
        $event->peserta();
    break;
    case "delete":
    if(isset($_SESSION['id'])){
        if(isset($_GET['id'])){         
         $event->deleteEvent($_GET['id']);
       }
    }else{
        header("Location: index.php");
    }   
    break;

    case "editakun":
        if(isset($_GET['id'])){
            $auth->editakun();
        }else{
            header("Location: index.php");
        }
    break;

    
    
}
