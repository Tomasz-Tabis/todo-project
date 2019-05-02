<?php

namespace App;
use App\Controllers\Connection;

include __DIR__ . '/controllers/Connection.php';

class User
{
    public $id;
    public $email;
    public $password;
    public $created_at;
    public $updated_at;
    public $deleted_at;

    private $whereQuery;

    public function __construct()
    {
    }

    public function set($data) {
        foreach ($data AS $key => $value){
            $this->{$key} = $value;
        }
    }

    public function create(){
        $conn = Connection::createConnection();
        $stmt = $conn->prepare("INSERT INTO users (id, email, password, created_at, updated_at, deleted_at) VALUES (:id, :email, :password, :created_at, :updated_at, :deleted_at)");
        $stmt->execute(array(
            "id" => $this->id,
            "email" => $this->email,
            "password" => md5($this->password),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "deleted_at" => $this->deleted_at
        ));
        return $this->find($conn->lastInsertId());
    }

    public function where($a, $b, $c){
        if ($this->whereQuery != null){
            $this->whereQuery .= " AND";
        }
        $this->whereQuery .= " $a $b '$c'";
        return $this;
    }

    public function get(){
        $conn = Connection::createConnection();
        $stmt = $conn->prepare("SELECT * FROM users WHERE $this->whereQuery");
        $stmt->execute();
        $this->set($stmt->fetch());
        return $this;
    }

    //Find user ID
    public static function find($id){
        $conn = Connection::createConnection();
        $stmt = $conn->prepare("SELECT * FROM users WHERE `id` = :id");
        $stmt->execute(array("id" => $id));
        $user = new User();
        $user->set($stmt->fetch());
        return $user;
    }

}