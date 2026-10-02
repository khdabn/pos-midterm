<!DOCTYPE html>
<html>
<head>
    <title>Login | POS System</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>

<div class="login-page">

    <div class="login-card">

        <h1>POS System</h1>

        <p class="login-subtitle">
            Staff Management & Point of Sale
        </p>

        <?php if (isset($validation)): ?>
            <div class="error-box">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>

        <?php if (isset($loginError)): ?>
            <div class="error-box">
                <?= esc($loginError) ?>
            </div>
        <?php endif; ?>

        <form action="/login" method="post">

            <?= csrf_field() ?>

            <div class="form-group">
                <label>Username</label>

                <input
                    type="text"
                    name="username"
                    value="<?= old('username') ?>"
                    placeholder="Enter username"
                >
            </div>

            <div class="form-group">
                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    placeholder="Enter password"
                >
            </div>

            <button
                type="submit"
                class="btn btn-primary"
                style="width:100%;"
            >
                Login
            </button>

        </form>

    </div>

</div>

</body>
</html>