<!DOCTYPE html>
<html>
<head>
    <title>New Customer</title>
</head>
<body>

<h1>New Customer</h1>

<nav>
    <a href="/customers">Back to Customers</a>
</nav>

<br>

<?php if (isset($validation)): ?>
    <div>
        <?= $validation->listErrors() ?>
    </div>
<?php endif; ?>

<form action="/customers/create" method="post">

    <?= csrf_field() ?>

    <p>
        <label>Full Name:</label><br>
        <input
            type="text"
            name="full_name"
            value="<?= old('full_name') ?>"
        >
    </p>

    <p>
        <label>Email:</label><br>
        <input
            type="text"
            name="email"
            value="<?= old('email') ?>"
        >
    </p>

    <p>
        <label>Phone:</label><br>
        <input
            type="text"
            name="phone"
            value="<?= old('phone') ?>"
        >
    </p>

    <button type="submit">Add Customer</button>

</form>

</body>
</html>