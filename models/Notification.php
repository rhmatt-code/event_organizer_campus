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
        $stmt = $this->db->prepare("SELECT n.*, e.title, users.name, users.email , e.event_date, e.description FROM notifications n JOIN events e ON e.id = n.event_id JOIN users ON n.user_id = users.id WHERE n.status = 'pending' AND e.event_date BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 1 DAY);
");
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
