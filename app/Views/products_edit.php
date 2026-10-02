<!DOCTYPE html>
<html>
<head>
    <title>Edit Product | POS System</title>
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
            <h1>Edit Product</h1>
            <p>Update product details, inventory, or image.</p>
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

        <?php if (!empty($product['image'])): ?>

            <div class="form-group">
                <label>Current Product Image</label>

                <img
                    src="/uploads/products/<?= esc($product['image']) ?>"
                    class="product-image"
                    alt="<?= esc($product['name']) ?>"
                >
            </div>

        <?php endif; ?>

        <form
            action="/products/update/<?= $product['id'] ?>"
            method="post"
            enctype="multipart/form-data"
        >

            <?= csrf_field() ?>

            <div class="form-group">
                <label>Product Name</label>

                <input
                    type="text"
                    name="name"
                    value="<?= old('name', $product['name']) ?>"
                >
            </div>

            <div class="form-group">
                <label>Price</label>

                <input
                    type="number"
                    name="price"
                    step="0.01"
                    min="0"
                    value="<?= old('price', $product['price']) ?>"
                >
            </div>

            <div class="form-group">
                <label>Stock Quantity</label>

                <input
                    type="number"
                    name="stock_quantity"
                    min="0"
                    value="<?= old('stock_quantity', $product['stock_quantity']) ?>"
                >
            </div>

            <div class="form-group">
                <label>Replace Product Image</label>

                <input
                    type="file"
                    name="image"
                    accept=".jpg,.jpeg,.png"
                >

                <small>
                    Leave blank to keep the current image. JPG or PNG, maximum 2 MB.
                </small>
            </div>

            <button type="submit" class="btn btn-primary">
                Update Product
            </button>

        </form>

    </div>

</div>

</body>
</html>