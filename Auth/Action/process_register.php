<?php
session_start();
require_once __DIR__ . '/../../Core/DB.php';
$conn = DB::connect();


function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


if (empty($_POST['name'])) {
    $nameErr = 'Name is required';
    $errors['name'] = $nameErr;
} else {
    $name = test_input($_POST['name']);
}



if (empty($_POST['email'])) {
    $emailErr = 'Email is required';
    $errors['email'] = $emailErr;
} else {
    $email = test_input($_POST['email']);
}


if (empty($_POST['password'])) {
    $passwordErr = 'Password is required';
    $errors['password'] = $passwordErr;
} else {
    $password = $_POST['password'];
}



if (!empty($errors)) {

    $_SESSION['errors'] = $errors;
    header("Location: ../register.php");
    exit();
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$checkQuery = "SELECT id FROM users WHERE email = ?";
$checkStmt = $conn->prepare($checkQuery);

if (!$checkStmt) {
    die("Prepare failed: " . $conn->error);
}

$checkStmt->bind_param("s", $email);
$checkStmt->execute();
$checkStmt->store_result();

if ($checkStmt->num_rows > 0) {
    $_SESSION['register_error'] = "Email already registered.";
    $checkStmt->close();
    header("Location: ../../auth/register.php");
    exit;
}
$checkStmt->close();


$insertQuery = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
$insertStmt = $conn->prepare($insertQuery);

if (!$insertStmt) {
    $_SESSION['register_error'] = "Something went wrong. Try again.";
    header("Location: ../../auth/register.php");
    exit;
}

$insertStmt->bind_param("sss", $name, $email, $hashedPassword);
$insertStmt->execute();
$insertStmt->close();

$_SESSION['user'] = [
    'id' => $conn->insert_id,
    'name' => $name,
    'email' => $email
];


header("Location: ../../index.php");
exit;
