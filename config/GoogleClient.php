<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Google\Client;
use Google\Service\Oauth2;

class GoogleClientConfig {
    public static function getClient() {
        $client = new Client();
        $client->setClientId($_ENV['GOOGLE_CLIENT_ID']);
        $client->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
        $client->setRedirectUri($_ENV['GOOGLE_REDIRECT_URI']);
        $client->setApplicationName($_ENV['GOOGLE_APP_NAME']);
        $client->addScope([
            "https://www.googleapis.com/auth/calendar",
            "https://www.googleapis.com/auth/calendar.events",
            "https://www.googleapis.com/auth/userinfo.email",
            "https://www.googleapis.com/auth/userinfo.profile",
            Google\Service\Calendar::CALENDAR
        ]);
        $client->setAccessType('offline');
        $client->setPrompt('consent');

        return $client;
    }
    
}
