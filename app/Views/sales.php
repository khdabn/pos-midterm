<!DOCTYPE html>
<html>
<head>
    <title>Sales History | POS System</title>
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
            <h1>Sales History</h1>
            <p>Review completed point-of-sale transactions.</p>
        </div>

        <a href="/sales/new" class="btn btn-primary">
            + Record Sale
        </a>

    </div>

    <div class="card">

        <div class="table-wrapper">

            <table>

                <tr>
                    <th>Product</th>
                    <th>Customer</th>
                    <th>Staff</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Date</th>
                </tr>

                <?php foreach ($sales as $sale): ?>

                    <tr>

                        <td>
                            <strong>
                                <?= esc($sale['product_name']) ?>
                            </strong>
                        </td>

                        <td>
                            <?php if (!empty($sale['customer_name'])): ?>

                                <?= esc($sale['customer_name']) ?>

                            <?php else: ?>

                                Walk-in Customer

                            <?php endif; ?>
                        </td>

                        <td>
                            <?= esc($sale['staff_name']) ?>
                        </td>

                        <td>
                            <?= esc($sale['quantity']) ?>
                        </td>

                        <td>
                            <strong>
                                ₱<?= number_format((float) $sale['total_price'], 2) ?>
                            </strong>
                        </td>

                        <td>
                            <?= esc($sale['created_at']) ?>
                        </td>

                    </tr>

                <?php endforeach; ?>

            </table>

        </div>

    </div>

</div>

</body>
</html>