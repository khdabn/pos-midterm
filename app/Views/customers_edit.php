<!DOCTYPE html>
<html>
<head>
    <title>Edit Customer</title>
</head>
<body>

<h1>Edit Customer</h1>

<a href="/customers">Back to Customers</a>

<br><br>

<?php if (isset($validation)): ?>
    <div>
        <?= $validation->listErrors() ?>
    </div>
<?php endif; ?>

<form action="/customers/update/<?= $customer['id'] ?>" method="post">

    <?= csrf_field() ?>

    <p>
        <label>Full Name:</label><br>
        <input
            type="text"
            name="full_name"
            value="<?= old('full_name', $customer['full_name']) ?>"
        >
    </p>

    <p>
        <label>Email:</label><br>
        <input
            type="text"
            name="email"
            value="<?= old('email', $customer['email']) ?>"
        >
    </p>

    <p>
        <label>Phone:</label><br>
        <input
            type="text"
            name="phone"
            value="<?= old('phone', $customer['phone']) ?>"
        >
    </p>

    <button type="submit">Update Customer</button>

</form>

</body>
</html>