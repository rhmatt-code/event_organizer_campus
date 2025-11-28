<?php 
require_once "config/database.php";


class Auth{
    private $db;

    public function __construct(){
        $this->db = (New Database())->connect();
    }
    public function register($namalengkap, $email, $role, $password){
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        
        $result = $this->db->prepare("INSERT INTO users(name, email, role, password) VALUES (?,?,?,?)");
        return $result->execute([$namalengkap, $email, $role, $passwordHash]);
        
    }

    public function login($email, $password){
        $statement = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $statement->execute([$email]);

        $result = $statement->get_result()->fetch_assoc();

        if($result && password_verify($password, $result["password"])){
            return $result;
        }
    }
}



?>