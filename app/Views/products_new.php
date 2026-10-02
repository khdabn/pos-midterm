<!DOCTYPE html>
<html>
<head>
    <title>Add Product | POS System</title>
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
            <h1>Add Product</h1>
            <p>Add a new product to your inventory.</p>
        </div>

        <a href="/products" class="btn btn-secondary">
            Back to Products
        </a>
    </div>

    <div class="card form-card">

        <?php if (isset($validation)): ?>
            <div class="error-box">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>

        <form
            action="/products/create"
            method="post"
            enctype="multipart/form-data"
        >

            <?= csrf_field() ?>

            <div class="form-group">
                <label>Product Name</label>
                <input
                    type="text"
                    name="name"
                    value="<?= old('name') ?>"
                >
            </div>

            <div class="form-group">
                <label>Price</label>
                <input
                    type="number"
                    name="price"
                    step="0.01"
                    min="0"
                    value="<?= old('price') ?>"
                >
            </div>

            <div class="form-group">
                <label>Stock Quantity</label>
                <input
                    type="number"
                    name="stock_quantity"
                    min="0"
                    value="<?= old('stock_quantity') ?>"
                >
            </div>

            <div class="form-group">
                <label>Product Image</label>
                <input
                    type="file"
                    name="image"
                    accept=".jpg,.jpeg,.png"
                >
                <small>JPG or PNG, maximum 2 MB.</small>
            </div>

            <button type="submit" class="btn btn-primary">
                Add Product
            </button>

        </form>

    </div>

</div>

</body>
</html>