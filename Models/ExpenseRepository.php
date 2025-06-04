<?php
require_once 'DB.php';

class ExpenseRepository
{
    private $conn;

    public function __construct()
    {
        $this->conn = DB::connect();
    }


    public function insertExpense(Expense $expense)
    {
        $stmt = $this->conn->prepare("INSERT INTO expenses (amount, category, date, description) VALUES (?, ?, ?, ?)");
        $stmt->bind_param(
            "dsss",
            $expense->getAmount(),
            $expense->getCategory(),
            $expense->getDate(),
            $expense->getDescription()
        );
        $stmt->execute();
        $stmt->close();
    }


    public function fetchAllExpenses()
    {
        $expenses = [];
        $result = $this->conn->query("SELECT * FROM expenses ORDER BY date DESC");

        while ($row = $result->fetch_assoc()) {
            $expenses[] = new Expense(
                $row["id"],
                $row['amount'],
                $row['category'],
                $row['date'],
                $row['description']
            );
        }
        return $expenses;
    }
}
