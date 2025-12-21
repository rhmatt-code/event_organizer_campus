<?php 


require_once "models/Auth.php";
require "config/GoogleClient.php";

class AuthController{
    
    public function login(){
        $client = GoogleClientConfig::getClient();
        if (!$client->getAccessToken()) {
            $authUrl = $client->createAuthUrl();
            header("Location: $authUrl");
            exit;
        }

    }

    public function callback() {
        if (!isset($_GET['code'])) {
            die('Login gagal');
        }

        $client = GoogleClientConfig::getClient();
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

        if (isset($token['error'])) {
            header("Location: index.php");
        }

        $client->setAccessToken($token);

        $oauth = new Google\Service\Oauth2($client);
        $userInfo = $oauth->userinfo->get();

        $email = $userInfo->email;
        $name  = $userInfo->name;

        $auth = new Auth();

        $user = $auth->loginOrRegister($name, $email, json_encode($token));

        $_SESSION['id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['token'] = json_encode($token);

        header("Location: index.php");
        exit;
    }


    public function editakun(){
        $id = $_GET['id'];
        $role = $_GET['role'];

        $model = new Auth();
        $update = $model->editakun($role, $id);

        header("Location: index.php");
    }

    public function logout(){
        
        $client = GoogleClientConfig::getClient();
        if (isset($_SESSION['token'])) {
            $client->revokeToken($_SESSION['token']);
            unset($_SESSION['token']);
        }
        session_destroy();

        header("location: index.php");
     }
};


?>