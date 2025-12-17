<?php
    require 'vendor/autoload.php';
    require 'config/database.php';
    require 'models/Notification.php';

    $notif = new NotificationModel();
    $list = $notif->getPendingReminder(1);

