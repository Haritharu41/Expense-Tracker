<?php
class DB
{
    public static function connect()
    {
        $conn = new mysqli("localhost", "root", "root", "expense_tracker");

        if ($conn->connect_error) {
            die("Database connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
}
