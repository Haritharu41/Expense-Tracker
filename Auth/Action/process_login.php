<?php
session_start();

require_once __DIR__ . '/../../Core/DB.php';

$conn = DB::connect();


if (empty($_POST['email'])) {
    $emailErr = 'Email is required';
    $errors['email'] = $emailErr;
} else {
    $email = trim($_POST['email']);
}

if (empty($_POST['password'])) {
    $passwordErr = 'Passwor is reuired';
    $errors['password'] = $passwordErr;
} else {
    $password = $_POST['password'];
}


if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: ../login.php");
    exit();
}

$query = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($query);

if (!$stmt) {

    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();


if ($user && password_verify($password, $user['password'])) {

    $_SESSION['user'] = [
        'id' => $user['id'],
        'name' => $user['name'],
        'email' => $user['email']
    ];

    $_SESSION['is_logged_in'] = true;

    header("Location:../../index.php");
    exit();
} else {

    $_SESSION['login_error'] = "Invalid credentials.";
    header("Location: ../login.php");
    exit();
}
