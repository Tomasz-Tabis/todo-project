<?php
namespace App\Controllers;
include "../User.php";
use App\User;

$path = $_SERVER['PATH_INFO'];
switch ($path){

    case '/register':
        $register = new RegisterController();
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