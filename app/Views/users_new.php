<!DOCTYPE html>
<html>
<head>
    <title>Add Staff | POS System</title>
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
            <h1>Add Staff</h1>
            <p>Create a new staff account.</p>
        </div>

        <a href="/users" class="btn btn-secondary">
            Back to Staff
        </a>
    </div>

    <div class="card form-card">

        <?php if (isset($validation)): ?>
            <div class="error-box">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>

        <form
            action="/users/create"
            method="post"
            enctype="multipart/form-data"
        >

            <?= csrf_field() ?>

            <div class="form-group">
                <label>Username</label>

                <input
                    type="text"
                    name="username"
                    value="<?= old('username') ?>"
                    placeholder="Enter username"
                >
            </div>

            <div class="form-group">
                <label>Full Name</label>

                <input
                    type="text"
                    name="full_name"
                    value="<?= old('full_name') ?>"
                    placeholder="Enter full name"
                >
            </div>

            <div class="form-group">
                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    placeholder="Enter password"
                >

                <small>Use at least 6 characters.</small>
            </div>

            <div class="form-group">
                <label>Avatar</label>

                <input
                    type="file"
                    name="avatar"
                    accept=".jpg,.jpeg,.png"
                >

                <small>JPG or PNG, maximum 2 MB.</small>
            </div>

            <button type="submit" class="btn btn-primary">
                Add Staff
            </button>

        </form>

    </div>

</div>

</body>
</html>