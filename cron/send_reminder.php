<?php
    require 'vendor/autoload.php';
    require 'config/database.php';
    require 'models/Notification.php';
    require 'controllers/NotificationsController.php';
    
    $controller = new NotificationController();
    $controller->send();
    $notif = new NotificationModel();
    $list = $notif->getPendingReminder(1);

