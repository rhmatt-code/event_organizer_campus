<?php

require_once 'config/GoogleClient.php';
require_once 'models/Auth.php';


class GoogleCalendarController {

    public function connect() {
        session_start();
        $userId = $_SESSION['id'];

        
        if (isset($_SESSION['token'])) {
            header("Location: index.php");
            exit;
        }

        
        $client = GoogleClientConfig::getClient();
         if (!$client->getAccessToken()) {
            $authUrl = $client->createAuthUrl();
            header("Location: $authUrl");
            exit;
        }
    }

    public function callback() {
        if (!isset($_SESSION['name'])) {
            echo "Unauthorized";
            exit;
        }

        $userId = $_SESSION['id'];
        $client = GoogleClientConfig::getClient();

        if (isset($_GET['code'])) {
            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
            if (isset($token['error'])) {
                die("Google token error: " . htmlspecialchars($token['error_description'] ?? $token['error']));
            }

            $userModel = new Auth();
            $userModel->saveGoogleToken($userId, json_encode($token));

            
            $_SESSION['token'] = $token;

            
            $client->setAccessToken($token);
            $oauth2 = new Google\Service\Oauth2($client);
            $userinfo = $oauth2->userinfo->get();

            $userModel->saveGoogleEmail($userId, $userinfo->email);
            $_SESSION['google_email'] = $userinfo->email;
            $_SESSION['google_name']  = $userinfo->name;

            header("Location: index.php");
            exit;
        } else {
            
            header("Location: index.php?page=oauthfailed");
            exit;
        }
    }

    
    public function disconnect() {
        if (!isset($_SESSION['user'])){ 
            header("Location: index.php");
        }
        $userId = $_SESSION['id'];
        $userModel = new Auth();
        $userModel->saveGoogleToken($userId, null);

        unset($_SESSION['token']);

        exit;
    }

}
