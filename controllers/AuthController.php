<?php 

require_once "models/Auth.php";

class AuthController{
    
    public function login(){
        
        if ($_SERVER['REQUEST_METHOD'] == "POST"){
            $email = $_POST["email"];
            $password = $_POST["password"];

            $userModel = new Auth();
            $user = $userModel->login($email, $password);

             if ($user && password_verify($_POST['password'], $user['password'])) {
                // set session user
                session_start();
                $_SESSION['user'] = $user;

                // Jika role panitia -> cek apakah sudah connect google
                if ($user['role'] === 'panitia') {
                    if (empty($user['google_token'])) {
                        // redirect otomatis ke flow google oauth
                        header("Location: index.php?page=connect");
                        exit;
                    } else {
                        // jika token ada di DB, restore ke session agar langsung bisa dipakai
                        $_SESSION['google_access_token'] = json_decode($user['google_token'], true);
                        header("Location: index.php");
                        exit;
                    }
                }
            // bukan panitia
            header("Location: index.php?");
            exit;
            } else {
                // login failed
                header("Location: index.php?=login?error=1");
                exit;
            }
            // if($user){
            //     session_start();
            //     $_SESSION['name'] = $user['name'];
            //     $_SESSION['role'] = $user['role'];
            //     header("Location: index.php");
            //     exit;
            // }else{
            //     $error = "Username atau Password Salah";
            //     header("Location: index.php");
                
            // }
        }

    }

    public function register(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $namalengkap = $_POST["fullname"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $role = "student";

            $userModel = new Auth();
            $update = $userModel->register($namalengkap, $email, $role, $password);
            header("location: index.php");
        }
        require "views/root/components/RegisterPage.php";
    }

    public function logout(){
        
        session_unset();
        session_destroy();

        header("location: index.php");
     }
};


?>