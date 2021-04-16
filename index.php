<?php

session_start();
require_once 'WebPage.php';
require_once 'users.php';
require_once 'HomePage.php';
require_once 'Flight_search.php';
require_once 'contact.php';
require_once 'Tool.php';

$session = new Tool();
$session->init();

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = 100;
}

switch ($op) {
    case 0:
        $home = new Home();
        $home->HomePage();
    break;

    case 1:
        $search = new Flight_search();
        $search->search();
    break;

    case 2:
        $con = new contactUS();
        $con->contact();
        break;
case 3:
    $edit = new Flight_search();
    $edit->EditBooking();
    break;

    case 5:
        $edit = new Flight_search();
        $edit->searchAll();
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

    case 56:
        $user = new users();
        $user->ForgetPassword();
    break;

    case 57:
        $user = new users();
        $user->VerifyForgetPassword();
    break;

    case 58:
        $user = new users();
        $user->updatePass();
    break;

    case 100:
        $user = new users();
        $user->Logout();
        break;

    default:
        echo 'Error';
    break;
}

function HomePage()
{
    $page = new WebPage();
    $page->Content = '<h1> Hello </h1>';
    $page->render();
}
