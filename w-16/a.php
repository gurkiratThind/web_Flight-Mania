<?php

session_start();
require_once 'WebPage.php';
require_once 'users.php';
require_once 'HomePage.php';
require_once 'abc.php';

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = 0;
}

switch ($op) {
    case 0:
        $home = new Home();
        $home->HomePage();
    break;

    case 1:
    $a = new Api();
    $a->api();
    break;

    case 51:
        $user = new users();
        $user->displayLoginPage();
    break;

    case 52:
        $user = new users();
        $user->verifyLogin();
    break;

    case 53:
        $user = new users();
        $user->registerUser();
    break;

    case 54:
        $user = new users();
        $user->verifyRegisterUser();
    break;

    case 55:
        $user = new users();
        $user->profile();
    break;

    case 100:
        $user = new users();
        $user->Logout();
        break;

    default:
        echo 'Error';
    break;
}
