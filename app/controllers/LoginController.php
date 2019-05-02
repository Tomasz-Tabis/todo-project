<?php

namespace App\Controllers;
include "../User.php";
use App\User;

$path = $_SERVER['PATH_INFO'];
switch ($path){
    case '/login':
        $login = new LoginController();
        $login->login();
        break;
    case '/logout':
        $login = new LoginController();
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
        header('Location: ../index.php');
    }
}