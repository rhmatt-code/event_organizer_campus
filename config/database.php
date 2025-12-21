<?php
require_once __DIR__ . '/../vendor/autoload.php';
require(__DIR__ . '/../config/bootstrap.php');


class database {

    private $host;
    private $user;
    private $pass;
    private $dbname;

    public function __construct(){
        $this->host   = $_ENV['DB_HOST'];
        $this->user   = $_ENV['DB_USER'];
        $this->pass   = $_ENV['DB_PASS'];
        $this->dbname = $_ENV['DB_NAME'];
    }

    public function connect(){
        return new mysqli($this->host, $this->user, $this->pass, $this->dbname);
    }
};
?>
