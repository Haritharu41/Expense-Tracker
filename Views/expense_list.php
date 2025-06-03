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
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
            <h1 class="mb-0 text-primary fw-bold">Expense Tracker</h1>
            <div class="d-flex gap-2">
                <form method="GET" action="index.php" class="m-0">
                    <input hidden name="report" value="summary">
                    <button type="submit" class="btn btn-outline-info shadow-sm d-flex align-items-center px-3 py-2 fw-semibold">
                        <i class="bi bi-bar-chart-fill me-2"></i> Get Summary Report
                    </button>
                </form>
                <a href="./Views/expense_form.php" class="text-decoration-none">
                    <button class="btn btn-success shadow-sm d-flex align-items-center">
                        <i class="bi bi-plus-circle me-1"></i> Add Expense
                    </button>
                </a>
                <form method="POST" onsubmit="return confirm('Are you sure you want to delete all expenses?');" class="m-0">
                    <button type="submit" class="btn btn-outline-danger shadow-sm d-flex align-items-center" name="delete_all">
                        <i class="bi bi-trash3 me-1"></i> Delete All Expenses
                    </button>
                </form>
            </div>
        </div>

        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h2 class="h4 mb-3 text-secondary">Expenses</h2>

                <form method="GET" action="index.php" class="mb-4">
                    <div class="row g-2 align-items-center">
                        <div class="col-auto">
                            <label for="category" class="col-form-label fw-semibold">Filter by category:</label>
                        </div>
                        <div class="col-auto">
                            <select name="category" id="category" class="form-select form-select-md border-primary" style="min-width:180px;" onchange="this.form.submit()">
                                <option value="all">All</option>
                                <option value="Food" <?= ($_GET['category'] ?? '') == 'Food' ? 'selected' : '' ?>>Food</option>
                                <option value="Travel" <?= ($_GET['category'] ?? '') == 'Travel' ? 'selected' : '' ?>>Travel</option>
                                <option value="Shopping" <?= ($_GET['category'] ?? '') == 'Shopping' ? 'selected' : '' ?>>Shopping</option>
                                <option value="Entertainment" <?= ($_GET['category'] ?? '') == 'Entertainment' ? 'selected' : '' ?>>Entertainment</option>
                                <option value="Home" <?= ($_GET['category'] ?? '') == 'Home' ? 'selected' : '' ?>>Home</option>
                                <option value="Family" <?= ($_GET['category'] ?? '') == 'Family' ? 'selected' : '' ?>>Family</option>
                                <option value="Health" <?= ($_GET['category'] ?? '') == 'Health' ? 'selected' : '' ?>>Health/Sport</option>
                            </select>
                        </div>
                    </div>
                </form>

                <?php if (count($expenses) > 0): ?>
                    <ul class="list-group">
                        <?php foreach ($expenses as $expense): ?>
                            <?php $d = $expense->getDetails(); ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="fw-bold text-success"><?= htmlspecialchars($d['amount']) ?></span>
                                    <span class="badge bg-info text-dark ms-2"><?= htmlspecialchars($d['category']) ?></span>
                                    <span class="ms-2"><?= htmlspecialchars($d['description']) ?></span>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <small class="text-muted"><?= htmlspecialchars($d['date']) ?></small>
                                    <!-- Edit Icon -->
                                    <a href="./Views/expense_editor.php?id=<?= urlencode($d['id']) ?>" class="btn btn-sm btn-outline-primary ms-2" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <!-- Delete Icon -->
                                    <form method="POST" class="d-inline" onsubmit="return confirm('Delete this expense?');">
                                        <input type="hidden" name="delete_id" value="<?= htmlspecialchars($d['id']) ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <div class="alert alert-info mt-3" role="alert">
                        No expenses recorded.
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h3 class="mb-0 text-secondary">Total Spent:</h3>
                <span class="fs-4 fw-bold text-primary"><?= htmlspecialchars($total) ?></span>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>