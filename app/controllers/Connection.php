<?php
namespace App\Controllers;
include "../../config/Database.php";
use Config\Database;

class Connection
{
    static public function createConnection(){
        $db = new Database();
        $server_address = $db->server_address;
        $database_name = $db->database_name;
        $username = $db->username;
        $password = $db->password;

        try{
            $conn = new \PDO("mysql:host=" . $server_address . ";dbname=" . $database_name , $username, $password);
            $conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
//            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION); //(To error's set it on)
            return $conn;
        }catch(\PDOException $e){
            return 'Connection failed: ' . $e->getMessage();
        }
    }
}