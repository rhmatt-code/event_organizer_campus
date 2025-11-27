<?php
session_start();

include "app/controllers/EventController.php";
include "app/controllers/AuthController.php";

$page = $_GET['page'] ?? 'index';

$event = new EventController();
$auth = new AuthController();

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

    case "logout":
        $auth->logout();
    break;
    
}
