<?php

    class base 
    {
        public $hostserver = "localhost";
        public $user = "root";
        public $pass = "";
        public $bdname = "cart";
        public $conn;

        public function __construct() 
        {
            try
            {
                $this->conn = new PDO('mysql:host='.$this->hostserver.'; dbname='.$this->bdname, $this->user, $this->pass);
            } catch(PDOException $error)
            {
                echo getMessage($error);
            }            
        }
    }