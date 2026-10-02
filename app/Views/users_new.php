<!DOCTYPE html>
<html>
<head>
    <title>New User</title>
</head>
<body>

<h1>New User</h1>

<nav>
    <a href="/users">Back to Users</a>
</nav>

<br>

<?php if (isset($validation)): ?>
    <div>
        <?= $validation->listErrors() ?>
    </div>
<?php endif; ?>

<form action="/users/create" method="post">

    <?= csrf_field() ?>

    <p>
        <label>Username:</label><br>
        <input
            type="text"
            name="username"
            value="<?= old('username') ?>"
        >
    </p>

    <p>
        <label>Full Name:</label><br>
        <input
            type="text"
            name="full_name"
            value="<?= old('full_name') ?>"
        >
    </p>

    <button type="submit">Add User</button>

</form>

</body>
</html>