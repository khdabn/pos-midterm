<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
</head>
<body>

    <h1>User Profile</h1>

    <nav>
        <a href="/">Home</a> |
        <a href="/tasks">Task List</a> |
        <a href="/profile">Profile</a> |
        <a href="/about">About</a>
    </nav>

    <br>

    <h2>Demo User</h2>

    <table border="1" cellpadding="10">
        <tr>
            <th>Username</th>
            <td><?= esc($user['username']) ?></td>
        </tr>

        <tr>
            <th>Full Name</th>
            <td><?= esc($user['full_name']) ?></td>
        </tr>

        <tr>
            <th>Email</th>
            <td><?= esc($user['email']) ?></td>
        </tr>

        <tr>
            <th>Created At</th>
            <td><?= esc($user['created_at']) ?></td>
        </tr>
    </table>

</body>
</html>