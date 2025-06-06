<?php


require_once './Models/ExpenseData.php';
require_once './Models/ExpenseModel.php';

class ExpenseController
{
    private $manager;
    public function __construct()

    {
        $this->manager = new ExpenseModel();
    }


    public function handleRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (isset($_POST['delete_all'])) {
                $this->manager->deleteAllExpenses();
                header("Location: index.php");
                exit;
            }

            if (isset($_POST['delete_id'])) {
                $this->manager->deleteExpenseById($_POST['delete_id']);
                header('Location: index.php');
                exit;
            }

            //store updated expense
            if (isset($_POST['action']) && $_POST['action'] === 'update') {
                $updatedExpense = new ExpenseData(
                    $_POST['uId'],
                    $_POST['uAmount'],
                    $_POST['uCategory'],
                    $_POST['uDate'],
                    $_POST['uDescription']
                );

                $this->manager->updateExpense($updatedExpense);
                header("Location: index.php");
                exit;
            }


            $expense = new ExpenseData(
                $_POST['id'],
                $_POST['amount'],
                $_POST['category'],
                $_POST['date'],
                $_POST['description']
            );


            if ($expense) {
                $this->manager->addExpense($expense);

                header("Location: index.php");
            }
        }

        // NEW: Check for category filter
        if (isset($_GET['category']) && $_GET['category'] !== 'all') {
            $category = $_GET['category'];


            $expenses = $this->manager->getExpensesByCategory($category);
            $total = $this->manager->getTotalExpenseByCategory($category);
        } else {
            $expenses = $this->manager->getAllExpenses();
            $total = $this->manager->getTotalExpense();
        }
        include './Views/expense_list.php';
    }


    public function showSummaryReport()
    {
        $summary = $this->manager->getSummaryByCategory();
        $total = $this->manager->getTotalExpense();


        include './Views/summary_report.php';
    }
}
