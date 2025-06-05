<?php
//enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/Core/Auth.php';




if (!isLoggedIn()) {
    $_SESSION['error'] = "You must be logged in to access this page";
    redirectToLogin();
}




require_once './Controllers/ExpenseController.php';
$controller = new ExpenseController();

if (isset($_GET['report']) && $_GET['report'] === 'summary') {
    $controller->showSummaryReport();
} else {
    $controller->handleRequest();
}
