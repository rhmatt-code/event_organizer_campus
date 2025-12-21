<?php
    require __DIR__.'/../vendor/autoload.php';
    require __DIR__.'/../config/database.php';
    require __DIR__.'/../models/Notification.php';
    require __DIR__.'/../controllers/NotificationsController.php';
    
    $controller = new NotificationController();
    $controller->send();
    $notif = new NotificationModel();
    $list = $notif->getPendingReminder(1);

