<?php

//enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);



require_once './Controllers/ExpenseController.php';
$controller = new ExpenseController();

if (isset($_GET['report']) && $_GET['report'] === 'summary') {
    $controller->showSummaryReport();
} else {
    $controller->handleRequest();
}
