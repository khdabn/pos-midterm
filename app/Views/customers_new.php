<!DOCTYPE html>
<html>
<head>
    <title>Add Customer | POS System</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>

<div class="topbar">
    <div class="brand">POS Management System</div>

    <div class="user-info">
        <?= esc(session()->get('full_name')) ?>
        <a href="/logout">Logout</a>
    </div>
</div>

<nav class="navbar">
    <a href="/products">Products</a>
    <a href="/customers">Customers</a>
    <a href="/users">Staff</a>
    <a href="/sales/new">Record Sale</a>
    <a href="/sales">Sales History</a>
</nav>

<div class="container">

    <div class="page-header">
        <div>
            <h1>Add Customer</h1>
            <p>Create a new customer account.</p>
        </div>

        <a href="/customers" class="btn btn-secondary">
            Back to Customers
        </a>
    </div>

    <div class="card form-card">

        <?php if (isset($validation)): ?>
            <div class="error-box">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>

        <form action="/customers/create" method="post">

            <?= csrf_field() ?>

            <div class="form-group">
                <label>Full Name</label>

                <input
                    type="text"
                    name="full_name"
                    value="<?= old('full_name') ?>"
                    placeholder="Enter customer name"
                >
            </div>

            <div class="form-group">
                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    value="<?= old('email') ?>"
                    placeholder="Enter email address"
                >
            </div>

            <div class="form-group">
                <label>Phone</label>

                <input
                    type="text"
                    name="phone"
                    value="<?= old('phone') ?>"
                    placeholder="Enter phone number"
                >
            </div>

            <button type="submit" class="btn btn-primary">
                Add Customer
            </button>

        </form>

    </div>

</div>

</body>
</html>