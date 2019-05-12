<?php

namespace App\Controllers;

include_once __DIR__ . "/../Classes.php";

use App\User;

session_start();

$path = $_SERVER['PATH_INFO'];
$register = new RegisterController();

switch ($path){

    case '/register':
        if (isset($_SESSION['loggedIn'])){
            header("HTTP/1.0 403 Forbidden");
        }
        $register->register();
        break;
    default:
        header("HTTP/1.0 404 Not Found");
        die;
}

class RegisterController
{
    public function register(){
        $request = $_POST;
        $user = new User();
        $user->email = $request['email'];
        $user->password = $request['password'];
        $user = $user->create();

        if ($user->created_at != null)
        {
            $_SESSION['success'] = 'Your account has been successfully created';
        }
        else {
            //Easter Egg
            $_SESSION['error'] = 'There is an internal server error. Try again later :)';
        }
        header('Location: ../../../index.php');
    }
}