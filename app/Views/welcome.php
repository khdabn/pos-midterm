<!DOCTYPE html>
<html>
<head>
    <title>Tasks for Today</title>
</head>
<body>

    <h1>Tasks for Today</h1>

    <nav>
        <a href="/">Home</a> |
        <a href="/tasks">Task List</a> |
        <a href="/profile">Profile</a> |
        <a href="/about">About</a>
    </nav>

    <br>

    <h2>Today's Tasks</h2>

    <table border="1" cellpadding="10">
        <tr>
            <th>Title</th>
            <th>Status</th>
            <th>Task Date</th>
        </tr>

        <?php foreach ($tasks as $task): ?>
            <tr>
                <td><?= esc($task['title']) ?></td>
                <td><?= esc($task['status']) ?></td>
                <td><?= esc($task['task_date']) ?></td>
            </tr>
        <?php endforeach; ?>

    </table>

</body>
</html>