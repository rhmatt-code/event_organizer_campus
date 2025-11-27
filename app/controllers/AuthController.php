<?php 

require_once "app/models/Auth.php";

class AuthController{
    
    public function login(){
        
        if ($_SERVER['REQUEST_METHOD'] == "POST"){
            $email = $_POST["email"];
            $password = $_POST["password"];

            $userModel = new Auth();
            $user = $userModel->login($email, $password);

            if($user){
                session_start();
                $_SESSION['user'] = $user;
                header("Location: index.php");
                exit;
            }else{
                $error = "Username atau Password Salah";
                header("Location: index.php");
                
            }
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
        require "app/views/root/components/RegisterPage.php";
    }

    public function logout(){
        session_destroy();

        header("location: index.php");
     }
};


?>