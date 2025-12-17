<?php
date_default_timezone_set('Asia/Jakarta');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/database.php';

$db = (New Database())->connect();

$db->query("
    UPDATE events
    SET status = 'ongoing'
    WHERE NOW() BETWEEN start_datetime AND end_datetime
");

$db->query("
    UPDATE events
    SET status = 'completed'
    WHERE end_datetime < NOW()
");
