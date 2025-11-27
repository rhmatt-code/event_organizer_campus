<?php

class database {

    private $host = "localhost";
    private $user = "root";
    private $pass = "5432";
    private $dbname = "campus_jaya";

    public function connect(){
        return new mysqli($this->host, $this->user, $this->pass, $this->dbname);
    }
};
?>
