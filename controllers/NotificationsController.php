<?php

use PHPMailer\PHPMailer\PHPMailer;
//require_once "models/Notification.php";

class NotificationController
{
    
    public function send()
    {
        $list = $this->notif->getPendingReminder(30);
        while ($row = $list->fetch_assoc()) {

            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host = $_ENV['SMTP_HOST'];
                $mail->SMTPAuth = true;
                $mail->Username = $_ENV['SMTP_USER'];
                $mail->Password = $_ENV['SMTP_PASS'];
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom($_ENV['SMTP_USER'], 'Event Reminder');
                $mail->addAddress($row['email']);

                $mail->isHTML(true);
                $mail->Subject = " Reminder Event: {$row['title']}";
                $mail->Body = "
                    <p>Halo <b>{$row['name']}</b>,</p>
                    <p>Ini adalah pengingat bahwa event <b>{$row['description']}</b> akan dilaksanakan <b>besok</b>.</p>
                    <p>🗓 Tanggal & waktu: {$row['event_date']}</p>
                    <p>Pastikan Anda hadir tepat waktu.</p>
                    <br>
                    <p>Salam,<br>Event Organizer</p>
                ";


                $mail->send();
                $email = new NotificationModel();
                $this->email->markSent($row['id']);

            } catch (Exception $e) {
                $email = new NotificationModel();
                $this->email->markFailed($row['id'], $e->getMessage());
            }
        }
    }
}
