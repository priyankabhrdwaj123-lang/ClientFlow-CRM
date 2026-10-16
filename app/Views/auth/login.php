<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($pageTitle ?? 'Login | ClientFlow CRM') ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>

<body class="auth-page">

    <div class="auth-container">
        <div class="auth-card">

            <a href="<?= site_url('/') ?>" class="brand auth-brand">
                Client<span>Flow</span>
            </a>


            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= esc(session()->getFlashdata('success')) ?>
                </div>
            <?php endif; ?>


            <div class="auth-heading">
                <h1>Welcome back</h1>
                <p>Sign in to continue to your workspace.</p>
            </div>

            <?php if (session()->has('error')): ?>
                <div class="alert alert-danger">
                    <?= esc(session('error')) ?>
                </div>
            <?php endif; ?>

            <?php if (session()->has('success')): ?>
                <div class="alert alert-success">
                    <?= esc(session('success')) ?>
                </div>
            <?php endif; ?>


            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= esc(session()->getFlashdata('error')) ?>
                </div>
            <?php endif; ?>


            <form action="<?= site_url('login') ?>" method="post">
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control"
                        placeholder="you@company.com"
                        autocomplete="email"
                        required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        placeholder="Enter your password"
                        autocomplete="current-password"
                        required>
                </div>

                <div class="auth-options">
                    <label class="remember-option">
                        <input type="checkbox" name="remember">
                        Remember me
                    </label>

                    <a href="#">Forgot password?</a>
                </div>

                <button type="submit" class="btn btn-primary auth-submit">
                    Sign In
                </button>
            </form>

            <p class="auth-footer">
                Don't have an account?
                <a href="<?= site_url('register') ?>">Create account</a>
            </p>

        </div>

        <p class="auth-copyright">
            &copy; <?= date('Y') ?> ClientFlow CRM. All rights reserved.
        </p>
    </div>

</body>

</html>