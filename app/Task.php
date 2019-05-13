<?php

namespace App;
use App\Controllers\Connection;

include_once __DIR__ . "/Classes.php";

class Task
{
    public $id;
    public $title;
    public $content;
    public $start_date;
    public $end_date;
    public $author_id;
    public $complete;
    public $created_at;
    public $updated_at;
    public $deleted_at;

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
        $stmt = $conn->prepare("INSERT INTO tasks (id, title, content, start_date, end_date, author_id, complete, created_at, updated_at, deleted_at) 
                                          VALUES (:id, :title, :content, :start_date, :end_date, :author_id, :complete, :created_at, :updated_at, :deleted_at)");
        $stmt->execute(array(
            "id" => $this->id,
            "title" => $this->title,
            "content" => $this->content,
            "start_date" => $this->start_date,
            "end_date" => $this->end_date,
            "author_id" => $this->author_id,
            "complete" =>$this->complete,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "deleted_at" => $this->deleted_at
        ));

        return $this->find($conn->lastInsertId());
    }

    //Returns new instance of task
    public static function find($id){
        $conn = Connection::createConnection();
        $stmt = $conn->prepare("SELECT * FROM tasks WHERE `id` = :id AND deleted_at IS NULL");
        $stmt->execute(array(
            "id" => $id,
        ));
        $task = new Task();
        $task->set($stmt->fetch());
        return $task;
    }

    public static function all($sort){
        switch ($sort){
            case 1:
                $sort = ",title ASC";
            break;
            case 2:
                $sort = ",title DESC";
                break;
            case 3:
                $sort = ",end_date DESC";
                break;
            default:
                $sort = ",end_date ASC";
        }


        $conn = Connection::createConnection();
        $stmt = $conn->prepare("SELECT * FROM tasks WHERE deleted_at IS NULL ORDER BY complete ASC" . $sort);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        $tasks = array();

        foreach ($rows as $row){
            $task = new Task();
            $task->set($row);
            array_push($tasks, $task);
        }

        return $tasks;
    }

    public function update(){
        $conn = Connection::createConnection();
        $stmt = $conn->prepare("UPDATE tasks SET title = :title, content = :content, start_date = :start_date, end_date = :end_date, author_id = :author_id, complete = :complete, updated_at = :updated_at, deleted_at = :deleted_at WHERE id=:id");
        $stmt->execute(array(
            "id" => $this->id,
            "title" => $this->title,
            "content" => $this->content,
            "start_date" => $this->start_date,
            "end_date" => $this->end_date,
            "author_id" => $this->author_id,
            "complete" => $this->complete,
            "updated_at" => date("Y-m-d"),
            "deleted_at" => $this->deleted_at,
        ));

        return $this;
    }
}