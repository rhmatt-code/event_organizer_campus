<?php
session_start();

include "controllers/EventController.php";
include "controllers/AuthController.php";
include "controllers/GoogleController.php";

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

    case "register":
        $auth->register();
    break;

    case "addevent":
        $event->addEvent();
    break;

    case "editevent":    
        $event->editEvent();
    break;

    case "delete":
       if(isset($_GET['id'])){         
         $event->deleteEvent($_GET['id']);
       }
    break;

    case "connect":
        $google->connect();
    break;

    case "callback";
        $google->callback();
    break;

    case "logout":
        $auth->logout();
    break;
    
}
