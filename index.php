<?php
session_start();

include "controllers/EventController.php";
include "controllers/AuthController.php";
include "controllers/GoogleController.php";
require 'config/bootstrap.php';



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
        // header("Location: index.php");
    }    
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

    case "connect":
    if(isset($_SESSION['id'])){
        $google->connect();
    }else{
        header("Location: index.php");
    }
    break;

    case "callback";
    if(isset($_SESSION['id'])){
        $google->callback();
    }else{
        header("Location: index.php");
    }
    break;

    case "logout":
    if(isset($_SESSION['id'])){
        $auth->logout();
        $google->disconnect();
    }else{
        header("Location: index.php");
    }
    break;
    
}
