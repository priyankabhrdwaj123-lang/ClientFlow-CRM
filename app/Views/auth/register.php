<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= esc($pageTitle ?? 'Create Account | ClientFlow CRM') ?></title>

    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>

<body class="auth-page">

    <div class="auth-container">
        <div class="auth-card">

            <a href="<?= site_url('/') ?>" class="brand auth-brand">
                Client<span>Flow</span>
            </a>

            <div class="auth-heading">
                <h1>Create your account</h1>
                <p>Get started with your ClientFlow workspace.</p>
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

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>


            <form action="<?= site_url('register') ?>" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="name">Full name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-control"
                        placeholder="Enter your full name"
                        autocomplete="name"
                        required>
                </div>

                <div class="form-group">
                    <label for="email">Work email</label>
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
                        placeholder="Create a password"
                        autocomplete="new-password"
                        minlength="8"
                        required>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm password</label>
                    <input
                        type="password"
                        id="confirm_password"
                        name="confirm_password"
                        class="form-control"
                        placeholder="Re-enter your password"
                        autocomplete="new-password"
                        minlength="8"
                        required>
                </div>

                <button type="submit" class="btn btn-primary auth-submit">
                    Create Account
                </button>
            </form>

            <p class="auth-footer">
                Already have an account?
                <a href="<?= site_url('login') ?>">Sign in</a>
            </p>

        </div>

        <p class="auth-copyright">
            &copy; <?= date('Y') ?> ClientFlow CRM. All rights reserved.
        </p>
    </div>

</body>

</html>