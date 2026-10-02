<!DOCTYPE html>
<html>
<head>
    <title>Staff | POS System</title>
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
            <h1>Staff</h1>
            <p>Manage staff accounts and profile information.</p>
        </div>

        <a href="/users/new" class="btn btn-primary">
            + Add Staff
        </a>

    </div>

    <div class="card">

        <div class="table-wrapper">

            <table>

                <tr>
                    <th>Avatar</th>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>

                <?php foreach ($users as $user): ?>

                    <tr>

                        <td>

                            <?php if (!empty($user['avatar'])): ?>

                                <img
                                    src="/uploads/avatars/<?= esc($user['avatar']) ?>"
                                    class="avatar"
                                    alt="Staff Avatar"
                                >

                            <?php else: ?>

                                <img
                                    src="/uploads/avatars/placeholder.png"
                                    class="avatar"
                                    alt="Default Avatar"
                                >

                            <?php endif; ?>

                        </td>

                        <td>
                            <strong>
                                <?= esc($user['username']) ?>
                            </strong>
                        </td>

                        <td>
                            <?= esc($user['full_name']) ?>
                        </td>

                        <td>
                            <?= esc($user['created_at']) ?>
                        </td>

                        <td>

                            <div class="actions">

                                <a
                                    href="/users/edit/<?= $user['id'] ?>"
                                    class="btn btn-edit"
                                >
                                    Edit
                                </a>

                                <?php if ((int) session()->get('user_id') !== (int) $user['id']): ?>

                                    <form
                                        action="/users/delete/<?= $user['id'] ?>"
                                        method="post"
                                    >

                                        <?= csrf_field() ?>

                                        <button
                                            type="submit"
                                            class="btn btn-danger"
                                            onclick="return confirm('Delete this staff member?')"
                                        >
                                            Delete
                                        </button>

                                    </form>

                                <?php endif; ?>

                            </div>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </table>

        </div>

    </div>

</div>

</body>
</html>