<!DOCTYPE html>
<html>
<head>
    <title>Products | POS System</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>

<div class="topbar">
    <div class="brand">
        POS Management System
    </div>

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
            <h1>Products</h1>
            <p>Manage products, prices, and inventory.</p>
        </div>

        <a href="/products/new" class="btn btn-primary">
            + Add Product
        </a>

    </div>

    <div class="card">

        <div class="table-wrapper">

            <table>

                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Action</th>
                </tr>

                <?php foreach ($products as $product): ?>

                    <tr>

                        <td>

                            <?php if (!empty($product['image'])): ?>

                                <img
                                    src="/uploads/products/<?= esc($product['image']) ?>"
                                    class="product-image"
                                    alt="<?= esc($product['name']) ?>"
                                >

                            <?php else: ?>

                                No Image

                            <?php endif; ?>

                        </td>

                        <td>
                            <strong>
                                <?= esc($product['name']) ?>
                            </strong>
                        </td>

                        <td>
                            ₱<?= number_format((float) $product['price'], 2) ?>
                        </td>

                        <td>

                            <?php if ((int) $product['stock_quantity'] <= 5): ?>

                                <span class="stock-low">
                                    <?= esc($product['stock_quantity']) ?>
                                    Low Stock
                                </span>

                            <?php else: ?>

                                <span class="stock-ok">
                                    <?= esc($product['stock_quantity']) ?>
                                    In Stock
                                </span>

                            <?php endif; ?>

                        </td>

                        <td>

                            <div class="actions">

                                <a
                                    href="/products/edit/<?= $product['id'] ?>"
                                    class="btn btn-edit"
                                >
                                    Edit
                                </a>

                                <form
                                    action="/products/delete/<?= $product['id'] ?>"
                                    method="post"
                                >

                                    <?= csrf_field() ?>

                                    <button
                                        type="submit"
                                        class="btn btn-danger"
                                        onclick="return confirm('Delete this product?')"
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