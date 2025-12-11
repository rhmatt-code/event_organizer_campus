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

    public function getAllUsers(){
        $result = $this->db->query("SELECT * FROM `users`");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function login($email, $password){
        $statement = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $statement->execute([$email]);

        $result = $statement->get_result()->fetch_assoc();

        if($result && password_verify($password, $result["password"])){
            return $result;
        } else {
            
            echo "<script> alert('Username atau Password tidak valid');
                window.location.href = 'index.php';
                </script>";
            
        }
    }

    public function editakun($role, $id){
        $query = "UPDATE users SET role='$role' WHERE id = $id ";
        return $this->db->query($query);
    }

    public function saveGoogleToken($userId, $tokenJson) {
        $stmt = $this->db->prepare("UPDATE users SET remember_token = ?, google_email = ? WHERE id = ?");
        $stmt->execute([$tokenJson, $this->findById($userId)['google_email'] ?? null, $userId]);
        return $stmt;
    }

    public function saveGoogleEmail($userId, $email) {
        $stmt = $this->db->prepare("UPDATE users SET google_email = ? WHERE id = ?");
        $stmt->execute([$email, $userId]);
        return $stmt;
    }  
    public function getGoogleToken($userId)
    {
        $stmt = $this->db->prepare("SELECT remember_token FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0){
            $row = $result->fetch_assoc();
            return $row['remember_token'];
        }
        return null;
    } 

    public function findById($id) {
        $stmt = $this->db->query("SELECT * FROM users WHERE id = $id");
        return $stmt->fetch_all(MYSQLI_ASSOC);
    }
}



?>