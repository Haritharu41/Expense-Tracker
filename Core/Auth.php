<?php
session_start();

function isLoggedIn()
{
    return isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true;
}

function redirectToLogin()
{
    header("Location: ./Auth/Login.php");
    exit();
}


function logout()
{
    session_destroy();
}
