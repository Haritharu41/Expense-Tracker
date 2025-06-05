<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Expense Summary Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 mb-4">
                    <div class="card-header bg-primary text-white text-center">
                        <h2 class="mb-0 fw-bold">Expense Summary Report</h2>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="index.php" class="row g-3 align-items-end mb-4">
                            <input type="hidden" name="report" value="monthly">
                            <div class="col-md-5">
                                <label for="start_date" class="form-label fw-semibold">Start Date</label>
                                <input type="date" name="start_date" id="start_date" class="form-control" value="<?= htmlspecialchars($_GET['start_date'] ?? '') ?>">
                            </div>
                            <div class="col-md-5">
                                <label for="end_date" class="form-label fw-semibold">End Date</label>
                                <input type="date" name="end_date" id="end_date" class="form-control" value="<?= htmlspecialchars($_GET['end_date'] ?? '') ?>">
                            </div>
                            <div class="col-md-2 d-grid">
                                <button type="submit" class="btn btn-primary fw-semibold">
                                    <i class="bi bi-funnel-fill me-1"></i> Filter
                                </button>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Category</th>
                                        <th scope="col " class="text-center">Total Amount</th>
                                        <th scope="col" class="text-end">Percentage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($summary as $category => $amount): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($category) ?></td>
                                            <td class="text-center text-success fw-semibold"><?= number_format($amount) ?></td>
                                            <td class="text-end text-success fw-semibold"><?= number_format(($amount / $total) * 100);
                                                                                            echo '%'; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr class="table-primary">
                                        <td class="fw-bold">Total</td>
                                        <td class="fw-bold text-center"><?= number_format($total) ?></td>
                                        <td class="fw-bold text-end">100%</td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4 text-center">
                            <a href="index.php" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Back to Expenses
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>