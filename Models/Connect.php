<?php
class Connect{
    private $host = "localhost";
    private $db ="task_product";
    private $user ="root";
    private $pass ="";
    public $conn;
    function __construct(){

            $this->conn = new PDO ("mysql:host=".$this->host.";dbname=".$this->db."","$this->user",$this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }
}