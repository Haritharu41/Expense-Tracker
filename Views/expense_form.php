<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Expense Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 class="mb-0 fw-bold">Add New Expense</h3>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" action="../index.php">
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Amount</label>
                                <input type="number" name="amount" class="form-control form-control-lg" min="0"
                                    placeholder="Enter amount" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Category</label>
                                <select name="category" class="form-select form-select-lg" required>
                                    <option value="" disabled selected>Select category</option>
                                    <option value="Food"> Food/Drinks</option>
                                    <option value="Shopping">
                                        Shopping</option>

                                    <option value="Entertainment">
                                        Entertainment</option>
                                    <option value="Home">
                                        Home</option>
                                    <option value="Family">
                                        Family</option>
                                    <option value="Health">

                                        Health/Sport</option>

                                    <option value="Travel">
                                        Travels</option>
                                    <option value="Other">

                                        Other (Expenses)</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Date</label>
                                <input type="date" name="date" class="form-control form-control-lg" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Description</label>
                                <input type="text" name="description" class="form-control form-control-lg"
                                    placeholder="Optional">
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <a href="../index.php" class="btn btn-outline-secondary btn-lg px-4">Back</a>
                                <button type="submit" class="btn btn-primary btn-lg px-4">Add Expense</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="text-center mt-4 text-muted small">
                    All fields except description are required.
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>