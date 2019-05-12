<?php

namespace App\Controllers;

include_once __DIR__. "/../Classes.php";

use App\Task;

session_start();

$path = $_SERVER['PATH_INFO'];
$task = new TasksController();

switch ($path){
    case '/create':
        $task->create();
        break;
    case '/update':
        $task->update();
        break;
    case '/delete':
        $task->delete();
        break;
    case '/complete':
        $task->complete();
        break;
    default:
        header("HTTP/1.0 404 Not Found");
        die;
}

class TasksController
{
    public function create(){
        $request = $_POST;
        $task = new Task();
        $task->title = $request['task-title'];
        $task->content = $request['task-content'];
        $task->start_date = $request['task-start-date'];
        $task->end_date = $request['task-start-end'];
        $task->author_id = $request['task-author'];
        $task->complete = 0;
        $task = $task->create();

        if ($task->created_at != null)
        {
            $_SESSION['success'] = 'Your account has been successfully created';
        }
        else {
            //Easter Egg
            $_SESSION['error'] = 'There is an internal server error. Try again later :)';
        }

        header('Location: ../../../list.php');
    }

    public function update(){
        $request = $_POST;
        $task = Task::find($request['task-id']);
        $task->title = $request['task-title'];
        $task->content = $request['task-content'];
        $task->start_date = $request['task-start-date'];
        $task->end_date = $request['task-start-end'];
        $task->author_id = $request['task-author'];
        $task->complete = 0;
        $task = $task->update();

        if ($task->created_at != null)
        {
            $_SESSION['success'] = 'Your account has been successfully updated';
        }
        else {
            //Easter Egg
            $_SESSION['error'] = 'There is an internal server error. Try again later :)';
        }

        header('Location: ../../../list.php');
    }

    public function delete(){
        $request = $_GET;
        $task = Task::find($request['id']);
        $task->deleted_at = date("Y-m-d");
        $task->update();

        header('Location: ../../../list.php');
    }

    public function complete(){
        $request = $_GET;
        $task = Task::find($request['id']);
        $task->complete = 1;
        $task->update();

        header('Location: ../../../list.php');
    }
}