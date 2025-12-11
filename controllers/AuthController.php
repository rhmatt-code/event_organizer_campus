<?php 

require_once "models/Auth.php";
require "config/GoogleClient.php";

class AuthController{
    
    public function login(){
        
        if ($_SERVER['REQUEST_METHOD'] == "POST"){
            $email = $_POST["email"];
            $password = $_POST["password"];

            $userModel = new Auth();
            $user = $userModel->login($email, $password);

           
            if($user){
                $_SESSION['id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['role'] = $user['role'];
                if ($user['role'] === 'organizer') {
                    if (empty($user['remember_token'])) {
                        header("Location: index.php?page=connect");
                        exit;
                    } else {
                        $_SESSION['token'] = json_decode($user['remember_token'], true);
                        header("Location: index.php");
                        exit;
                    }
                }
                
                header("Location: index.php");
                exit;
            }else{
                echo "<script> alert('Username atau Password tidak valid');
                window.location.href = 'index.php';
                </script>";
                
            }
        }
        echo "<script> alert('Username atau Password tidak valid');
                window.location.href = 'index.php';
                </script>";

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
            $client->revokeToken($_SESSION['token']); // cabut token
            unset($_SESSION['token']); // hapus session token
        }
        session_destroy();

        header("location: index.php");
     }
};


?>