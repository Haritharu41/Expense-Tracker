<?php
require_once __DIR__ . '/../Core/Auth.php';

logout();
header("Location: Login.php");
exit();
