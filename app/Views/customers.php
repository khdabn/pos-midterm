<!DOCTYPE html>
<html>
<head>
    <title>Customers | POS System</title>
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
            <h1>Customers</h1>
            <p>Manage customer accounts and contact information.</p>
        </div>

        <a href="/customers/new" class="btn btn-primary">
            + Add Customer
        </a>
    </div>

    <div class="card">

        <div class="table-wrapper">

            <table>

                <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>

                <?php foreach ($customers as $customer): ?>

                    <tr>

                        <td>
                            <strong>
                                <?= esc($customer['full_name']) ?>
                            </strong>
                        </td>

                        <td>
                            <?= esc($customer['email']) ?>
                        </td>

                        <td>
                            <?= esc($customer['phone']) ?>
                        </td>

                        <td>

                            <div class="actions">

                                <a
                                    href="/customers/edit/<?= $customer['id'] ?>"
                                    class="btn btn-edit"
                                >
                                    Edit
                                </a>

                                <form
                                    action="/customers/delete/<?= $customer['id'] ?>"
                                    method="post"
                                >

                                    <?= csrf_field() ?>

                                    <button
                                        type="submit"
                                        class="btn btn-danger"
                                        onclick="return confirm('Delete this customer?')"
                                    >
                                        Delete
                                    </button>

                                </form>

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