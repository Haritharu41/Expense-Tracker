<?php

require_once './Controllers/ExpenseController.php';
require_once __DIR__ . '/Core/Auth.php';
$controller = new ExpenseController();


if (!isLoggedIn()) {
    $_SESSION['error'] = "You must be logged in to access this page";
    redirectToLogin();
}


if (isset($_GET['report']) && $_GET['report'] === 'summary') {

    $controller->showSummaryReport();
} else {

    $controller->handleRequest();
}
