<?php 
require_once __DIR__."/../config/database.php";


class Auth{
    private $db;

    public function __construct(){
        $this->db = (New Database())->connect();
    }

    public function getAllUsers(){
        $result = $this->db->query("SELECT * FROM `users`");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function loginOrRegister($name, $email, $googleToken){
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $result = $stmt->get_result();

        if($user = $result->fetch_assoc()){
            $id = $user['id'];
            $update = $this->db->prepare("UPDATE users SET remember_token = '$googleToken' WHERE id = '$id'");
            $update->execute();

            return $user;
        }else{

        $stmt = $this->db->prepare("INSERT INTO users (name, email, remember_token) VALUES (?,?,?)");
        $stmt->bind_param("sss", $name, $email, $googleToken);
        $stmt->execute();

        return ['id' => $this->db->insert_id,'name' => $name, 'email' => $email, 'role' => 'student'];
        };

    }

    public function editakun($role, $id){
        $query = "UPDATE users SET role='$role' WHERE id = $id ";
        return $this->db->query($query);
    }

    public function saveGoogleToken($userId, $tokenJson) {
        $stmt = $this->db->prepare("UPDATE users SET remember_token = ? WHERE id = ?");
        $stmt->execute([$tokenJson, $userId]);
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
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = $id");
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}



?>