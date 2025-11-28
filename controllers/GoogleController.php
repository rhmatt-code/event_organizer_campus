<?php

require_once 'config/GoogleClient.php';
require 'models/Auth.php';

class GoogleCalendarController {

     public function connect() {
        session_start();
        // pastikan user login internal
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit;
        }

        $userId = $_SESSION['user']['id'];

        // Jika token sudah ada di session atau DB, skip redirect
        if (isset($_SESSION['google_access_token'])) {
            header("Location: /dashboard");
            exit;
        }

        // build client
        $client = GoogleClientConfig::getClient();
        $authUrl = $client->createAuthUrl();
        header("Location: $authUrl");
        exit;
    }

    public function callback() {
        session_start();
        if (!isset($_SESSION['user'])) {
            echo "Unauthorized";
            exit;
        }

        $userId = $_SESSION['user']['id'];
        $client = GoogleClientConfig::getClient();

        if (isset($_GET['code'])) {
            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

            if (isset($token['error'])) {
                // handle error
                die("Google token error: " . htmlspecialchars($token['error_description'] ?? $token['error']));
            }

            // Simpan token ke DB (string JSON), penting: simpan refresh_token jika ada
            $userModel = new User();
            $userModel->saveGoogleToken($userId, json_encode($token));

            // Simpan ke session agar langsung bisa dipakai
            $_SESSION['google_access_token'] = $token;

            // Ambil userinfo (email, name) lalu simpan juga
            $client->setAccessToken($token);
            $oauth2 = new Google\Service\Oauth2($client);
            $userinfo = $oauth2->userinfo->get();

            $userModel->saveGoogleEmail($userId, $userinfo->email);
            $_SESSION['google_email'] = $userinfo->email;
            $_SESSION['google_name']  = $userinfo->name;

            header("Location: /dashboard");
            exit;
        } else {
            // error: code not present
            header("Location: /dashboard?oauth=failed");
            exit;
        }
    }

    // optional: disconnect (hapus token)
    public function disconnect() {
        session_start();
        if (!isset($_SESSION['user'])) header("Location: /login");

        $userId = $_SESSION['user']['id'];
        $userModel = new User();
        $userModel->saveGoogleToken($userId, null);

        unset($_SESSION['google_access_token']);
        unset($_SESSION['google_email']);
        unset($_SESSION['google_name']);

        header("Location: /dashboard?google=disconnected");
        exit;
    }

    public function createEventToGoogle($eventData){
        $client = GoogleClientConfig::getClient();
        $service = new Google\Service\Calendar($client);

        $event = new Google\Service\Calendar\Event([
            'summary' => $eventData['title'],
            'location' => $eventData['location'],
            'description' => $eventData['description'],
            'start' => [
                'dateTime' => $eventData['start_date'],
                'timeZone' => 'Asia/Jakarta',
            ],
            'end' => [
                'dateTime' => $eventData['end_date'],
                'timeZone' => 'Asia/Jakarta',
            ],
        ]);

        $calendarId = 'primary';
        $googleEvent = $service->events->insert($calendarId, $event);

        return $googleEvent->id; // simpan di DB
    }

}
