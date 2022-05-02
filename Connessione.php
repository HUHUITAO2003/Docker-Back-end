<?php

class Connessione {
    private $host = "172.17.0.1:3306";
    private $user = "root";
    private $pass = "hu12hui26tao";
    private $db = "mydb";

    function connect(){
        $connessione = new mysqli($this->host, $this->user, $this->pass, $this->db) 
        or die("Connessione non riuscita " . mysqli_connect_error() );
        return $connessione;
    }

}
?>
