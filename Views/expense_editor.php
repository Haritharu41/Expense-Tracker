<?php
// enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../Models/ExpenseModel.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;
if (!$id) {
    header("Location: ../index.php");
    exit;
}
$getExpenseBy = new ExpenseModel();
$expense = $getExpenseBy->getExpenseById($id);
$expense = $expense ? $expense->getDetails() : null;
if (!$expense) {
    header("Location: ../index.php");
    exit;
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Expense Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Update Expense</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="../index.php">


                            <div class="mb-3">
                                <label class="form-label">Amount</label>
                                <input type="hidden" name="uId" value="<?php echo $expense['id'] ?>">
                                <input type="number" name="uAmount" value=<?php echo $expense['amount'] ?> class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <input type="text" name="uCategory" class="form-control" value=<?php echo $expense['category'] ?> required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Date</label>
                                <input type="date" name="uDate" class="form-control" value=<?php echo $expense['date'] ?> required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <input type="text" name="uDescription" class="form-control" value=<?php echo $expense['description'] ?>>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="../index.php" class="btn btn-secondary">Back</a>
                                <button type="submit" class="btn btn-primary">Add Expense</button>
                            </div>
                            <input name="action" value="update" hidden>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>