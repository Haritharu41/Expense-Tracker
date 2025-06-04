<?php
require_once __DIR__ . '/../Core/DB.php';
require_once 'ExpenseData.php';

class ExpenseModel
{
    private $conn;
    private $repo;
    public function __construct()
    {
        $this->conn = DB::connect();
    }

    public function addExpense($expense)
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

    public function getAllExpenses()
    {
        $expenses = [];
        $result = $this->conn->query("SELECT * FROM expenses ORDER BY date DESC");

        while ($row = $result->fetch_assoc()) {
            $expenses[] = new ExpenseData(
                $row["id"],
                $row['amount'],
                $row['category'],
                $row['date'],
                $row['description']
            );
        }
        return $expenses;
    }


    public function getTotalExpense()
    {
        $result = $this->conn->query("SELECT SUM(amount) AS total FROM expenses");
        $row = $result->fetch_assoc();
        return $row['total'] ?? 0;
    }

    public function getTotalExpenseByCategory($category)
    {
        $result = $this->conn->query("SELECT SUM(amount) AS total FROM expenses WHERE category = '$category'");
        $row = $result->fetch_assoc();
        return $row['total'] ?? 0;
    }

    public function deleteAllExpenses()
    {
        $this->conn->query("DELETE FROM expenses");
    }

    public function  deleteExpenseById($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM expenses WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    public function getExpenseById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM expenses WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $expenseData = $result->fetch_assoc();
        $stmt->close();

        if ($expenseData) {
            return new ExpenseData(
                $expenseData["id"],
                $expenseData['amount'],
                $expenseData['category'],
                $expenseData['date'],
                $expenseData['description']
            );
        }

        return null;
    }


    public function getExpensesByCategory($category)
    {
        $stmt = $this->conn->prepare("SELECT * FROM expenses WHERE category = ? ORDER BY date DESC");
        $stmt->bind_param("s", $category);
        $stmt->execute();
        $result = $stmt->get_result();

        $expenses = [];
        while ($row = $result->fetch_assoc()) {
            $expenses[] = new ExpenseData(
                $row["id"],
                $row['amount'],
                $row['category'],
                $row['date'],
                $row['description']
            );
        }

        $stmt->close();
        return $expenses;
    }

    public function updateExpense($updatedExpense)
    {
        $stmt = $this->conn->prepare("UPDATE expenses SET amount = ?, category = ?, date = ?, description = ? WHERE id = ?");
        $stmt->bind_param(
            "dsssi",
            $updatedExpense->getAmount(),
            $updatedExpense->getCategory(),
            $updatedExpense->getDate(),
            $updatedExpense->getDescription(),

            $updatedExpense->getId()
        );
        $stmt->execute();
        $stmt->close();
    }

    public function getSummaryByCategory()
    {
        $summary = [];
        $query = "SELECT category, SUM(amount) as total FROM expenses GROUP BY category";
        $result = $this->conn->query($query);

        while ($row = $result->fetch_assoc()) {
            $summary[$row['category']] = $row['total'];
        }

        return $summary;
    }
}
