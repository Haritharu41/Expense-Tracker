<?php
require_once './Controllers/ExpenseController.php';
$controller = new ExpenseController();

if (isset($_GET['report']) && $_GET['report'] === 'summary') {
    $controller->showSummaryReport();
} else {
    $controller->handleRequest();
}
