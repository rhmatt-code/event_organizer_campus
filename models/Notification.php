<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class NotificationModel
{
    private $db;

    public function __construct(){
        $this->db = (New Database())->connect();
    }
    
    public function createNotification($eventId, $userId, $email){
        $stmt = $this->db->prepare("INSERT INTO notifications (user_id, event_id, email) VALUES ('$eventId', $userId, '$email')");
        return $stmt->execute();
    }

    public function getPendingReminder($day = 1){
        $stmt = $this->db->prepare("SELECT n.*, e.title, e.event_date, e.description FROM notifications n JOIN events e ON e.id = n.event_id WHERE n.status = 'pending' AND e.start_datetime BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL $day DAYS)");
        $stmt->execute();
        return $stmt->get_result();
    }

    public function markSent($id){
        $stmt = $this->db->prepare("UPDATE notifications SET status='sent', sent_at=NOW() WHERE id = $id");
        return $stmt->execute();
    }

    public function markFailed($id, $error){
        $stmt = $this->db->prepare("UPDATE notifications SET status='failed', error_message='$error' WHERE id = $id");
        
        return $stmt->execute();
    }
}
