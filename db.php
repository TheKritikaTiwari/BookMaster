<?php
class db{
    protected $connection;
    function setConnection(){
        try{
            $this->connection = new PDO("mysql:host=localhost;dbname=library_management_system","root","");
        } catch(PDOException $e){
                echo "Error";
        }
    }
}