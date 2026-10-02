<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>

<h1>Edit User</h1>

<a href="/users">Back to Users</a>

<br><br>

<?php if (isset($validation)): ?>
    <div>
        <?= $validation->listErrors() ?>
    </div>
<?php endif; ?>

<form action="/users/update/<?= $user['id'] ?>"
      method="post"
      enctype="multipart/form-data">

    <?= csrf_field() ?>

    <p>
        <label>Username:</label><br>
        <input
            type="text"
            name="username"
            value="<?= old('username', $user['username']) ?>"
        >
    </p>

    <p>
        <label>Full Name:</label><br>
        <input
            type="text"
            name="full_name"
            value="<?= old('full_name', $user['full_name']) ?>"
        >
    </p>

    <p>
        <label>Profile Picture:</label><br>
        <input
            type="file"
            name="avatar"
            accept=".jpg,.jpeg,.png"
        >
    </p>

    <button type="submit">Update User</button>

</form>

</body>
</html>