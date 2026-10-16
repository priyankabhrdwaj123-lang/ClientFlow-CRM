<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-header">
    <div>
        <h1 class="page-title">Edit Customer</h1>
        <p class="page-subtitle">Update customer information.</p>
    </div>

    <a href="<?= site_url('customers') ?>" class="btn btn-primary">
        Back to Customers
    </a>
</div>

<?php if (session()->has('errors')): ?>
    <div class="alert alert-error">
        <?php foreach (session('errors') as $error): ?>
            <p><?= esc($error) ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<div class="card">
    <form
        action="<?= site_url('customers/update/' . $customer['id']) ?>"
        method="post"
    >
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="name" class="form-label">Customer Name *</label>
            <input
                type="text"
                id="name"
                name="name"
                class="form-control"
                value="<?= esc(old('name', $customer['name'])) ?>"
                maxlength="100"
                required
            >
        </div>

        <div class="form-group">
            <label for="email" class="form-label">Email Address *</label>
            <input
                type="email"
                id="email"
                name="email"
                class="form-control"
                value="<?= esc(old('email', $customer['email'])) ?>"
                maxlength="150"
                required
            >
        </div>

        <div class="form-group">
            <label for="phone" class="form-label">Phone Number</label>
            <input
                type="text"
                id="phone"
                name="phone"
                class="form-control"
                value="<?= esc(old('phone', $customer['phone'] ?? '')) ?>"
                maxlength="20"
            >
        </div>

        <div class="form-group">
            <label for="company" class="form-label">Company</label>
            <input
                type="text"
                id="company"
                name="company"
                class="form-control"
                value="<?= esc(old('company', $customer['company'] ?? '')) ?>"
                maxlength="150"
            >
        </div>

        <button type="submit" class="btn btn-primary">
            Update Customer
        </button>
    </form>
</div>

<?= $this->endSection() ?>
