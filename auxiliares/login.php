<?php

require_once 'src/Google/autoload.php';

session_start();
if (!isLoggedIn()) {
    defined('index') or defined('loginForm') or redirect("./");
}

function redirect($url) {
    header("Location: $url");
    die();
}

function isLoggedIn() {
    return isset($_SESSION['userid']);
}

function checkLogin() {
    $client = new Google_Client();
    $client->setAuthConfigFile($_SERVER['HTTP_HOST'] == 'localhost' ? 'google_cred.localhost.json' : 'google_cred.json');
    $client->addScope(Google_Service_Oauth2::USERINFO_EMAIL);
    $service = new Google_Service_Oauth2($client);

    if (isset($_GET['code'])) {
        $client->authenticate($_GET['code']);
        $_SESSION['access_token'] = $client->getAccessToken();  
    }

    if (isset($_GET['error'])) {
        $_SESSION['errorLogin'] = $_GET['error'];
        return false;
    }

    if (isset($_SESSION['access_token'])) {
        $client->setAccessToken($_SESSION['access_token']);
        $user = $service->userinfo->get();
        $_SESSION['userid'] = $user['name'];
        return true;
    } else {        
        redirect($client->createAuthUrl());
    }

    return false;
}

function hayError() {
    return isset($_SESSION['errorLogin']);
}

function getError() {
    return $_SESSION['errorLogin'];
}

function printUserData() {
    if (isLoggedIn()) {
        echo "<li><a href='logout.php' title='Logout'>";
        echo $_SESSION['userid'];
        echo "</a></li>";
    } else {
        echo "<li><a href='login.php'>Ingresar</a></li>";
    }
}

function getID($mail) {
    return str_replace("@", "-", str_replace(".", "-", $mail));
}


?>