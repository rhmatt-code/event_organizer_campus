<?php

require_once  __DIR__ ."/../vendor/autoload.php";

use Google\Client;

class GoogleClientConfig {

    public static function getClient() {
        $client = new Client();
        $client->setAuthConfig(__DIR__ . '/credentials.json');
        $client->addScope(Google\Service\Calendar::CALENDAR);
        $client->setRedirectUri('http://localhost/fp-event_organizer_campus/index.php?page=callback');
        $client->setAccessType('offline');
        $client->setPrompt('consent');

        // Load existing token if exists
        $tokenPath = __DIR__ . '/token.json';
        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            $client->setAccessToken($accessToken);
            if ($client->isAccessTokenExpired()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
                file_put_contents($tokenPath, json_encode($client->getAccessToken()));
            }
        }

        return $client;
    }
}
