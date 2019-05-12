<?php

namespace App\Controllers;

include_once __DIR__ . "/../Classes.php";

use App\User;

session_start();

$path = $_SERVER['PATH_INFO'];
$login = new LoginController();

switch ($path){
    case '/login':
        if (isset($_SESSION['loggedIn'])){
            header("Location: ../../../list.php");
        }
        $login->login();
        break;
    case '/logout':
        if (!isset($_SESSION['loggedIn'])){
            header("Location: ../../../index.php");
        }
        $login->logout();
        break;
    default:
        header("HTTP/1.0 404 Not Found");
        die;
}

class LoginController
{
    public function login(){
        $request = $_POST;
        $user = new User();
        $user = $user->where("email", "=",$request['email'])->where("password", "=", md5($request['password']))->get();
        if ($user->id != null){
            $_SESSION['loggedIn'] = 'You are logged in as: ' . $user->email;
            header('Location: ../../../list.php');
        }
        else{
            $_SESSION['error'] = 'You can not log in.';
            header('Location: ../../../index.php');
        }
    }

    public function logout(){ //GOOD
        session_destroy();
        header('Location: ../../../index.php');
    }
}