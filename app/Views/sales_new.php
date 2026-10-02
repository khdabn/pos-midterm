<!DOCTYPE html>
<html>
<head>
    <title>Record Sale | POS System</title>
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
            <h1>Record Sale</h1>
            <p>Create a new point-of-sale transaction.</p>
        </div>

        <a href="/sales" class="btn btn-secondary">
            Sales History
        </a>
    </div>

    <div class="card form-card">

        <?php if (isset($validation)): ?>
            <div class="error-box">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>

        <?php if (isset($saleError)): ?>
            <div class="error-box">
                <?= esc($saleError) ?>
            </div>
        <?php endif; ?>

        <form action="/sales/create" method="post">

            <?= csrf_field() ?>

            <div class="form-group">
                <label>Product</label>

                <select name="product_id">
                    <option value="">Select Product</option>

                    <?php foreach ($products as $product): ?>
                        <option
                            value="<?= $product['id'] ?>"
                            <?= old('product_id') == $product['id'] ? 'selected' : '' ?>
                        >
                            <?= esc($product['name']) ?>
                            — ₱<?= number_format((float) $product['price'], 2) ?>
                            — Stock: <?= esc($product['stock_quantity']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Customer</label>

                <select name="customer_id">
                    <option value="">Walk-in Customer</option>

                    <?php foreach ($customers as $customer): ?>
                        <option
                            value="<?= $customer['id'] ?>"
                            <?= old('customer_id') == $customer['id'] ? 'selected' : '' ?>
                        >
                            <?= esc($customer['full_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <small>Customer selection is optional.</small>
            </div>

            <div class="form-group">
                <label>Quantity</label>

                <input
                    type="number"
                    name="quantity"
                    min="1"
                    value="<?= old('quantity') ?>"
                >
            </div>

            <button type="submit" class="btn btn-primary">
                Record Sale
            </button>

        </form>

    </div>

</div>

</body>
</html>