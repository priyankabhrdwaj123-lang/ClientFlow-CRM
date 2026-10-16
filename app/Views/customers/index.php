<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-header">
    <div>
        <h1 class="page-title">Customers</h1>
        <p class="page-subtitle">
            Manage your ClientFlow CRM customers.
        </p>
    </div>

    <a href="<?= site_url('customers/create') ?>" class="btn btn-primary">
        + Add Customer
    </a>
</div>



<div class="card customer-search-card">
    <form
        action="<?= site_url('customers') ?>"
        method="get"
        class="customer-search-form">

        <div class="search-input-wrap">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <circle cx="11" cy="11" r="7"></circle>
                <path d="m16 16 4 4"></path>
            </svg>

            <input
                type="search"
                name="search"
                class="form-control"
                placeholder="Search by name, email, phone or company..."
                value="<?= esc($search ?? '') ?>">
        </div>

        <select name="sort" class="form-control" aria-label="Sort customers">
            <option value="newest"
                <?= ($sort ?? 'newest') === 'newest' ? 'selected' : '' ?>>
                Newest First
            </option>

            <option value="name"
                <?= ($sort ?? '') === 'name' ? 'selected' : '' ?>>
                Name A–Z
            </option>

            <option value="company"
                <?= ($sort ?? '') === 'company' ? 'selected' : '' ?>>
                Company A–Z
            </option>
        </select>

        <button type="submit" class="btn btn-primary">
            Search
        </button>

        <?php if (! empty($search) || ($sort ?? 'newest') !== 'newest'): ?>
            <a href="<?= site_url('customers') ?>" class="btn btn-secondary">
                Clear
            </a>
        <?php endif; ?>

    </form>
</div>



<?php if (session()->has('success')): ?>
    <div class="alert alert-success">
        <?= esc(session('success')) ?>
    </div>
<?php endif; ?>


<div class="card">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Company</th>
                    <th>Actions</th>

                </tr>
            </thead>

            <tbody>
                <?php if (! empty($customers)): ?>
                    <?php foreach ($customers as $customer): ?>
                        <tr>
                            <td><?= esc($customer['id']) ?></td>
                            <td><?= esc($customer['name']) ?></td>
                            <td><?= esc($customer['email']) ?></td>
                            <td><?= esc($customer['phone'] ?? '') ?></td>
                            <td><?= esc($customer['company'] ?? '') ?></td>
                            <!-- Actions for this customer -->

                            <td>
                                <div class="customer-actions">
                                    <a
                                        href="<?= site_url('customers/' . $customer['id'] . '/edit') ?>"
                                        class="action-btn edit-btn"
                                        title="Edit Customer"
                                        aria-label="Edit Customer">
                                        <svg viewBox="0 0 24 24" aria-hidden="true">
                                            <path d="M12 20h9" />
                                            <path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L9 17l-4 1 1-4Z" />
                                        </svg>
                                        <span></span>
                                    </a>



                                    <form
                                        action="<?= site_url('customers/delete/' . $customer['id']) ?>"
                                        method="post"
                                        onsubmit="return confirm('Are you sure you want to delete this customer?');">
                                        <?= csrf_field() ?>

                                        <button
                                            type="submit"
                                            class="action-btn delete-btn"
                                            title="Delete Customer"
                                            aria-label="Delete Customer">
                                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                                <path d="M3 6h18" />
                                                <path d="M8 6V4h8v2" />
                                                <path d="m19 6-1 14H6L5 6" />
                                                <path d="M10 11v5M14 11v5" />
                                            </svg>
                                            <span></span>
                                        </button>
                                    </form>


                                    <a href="<?= site_url('customers/' . $customer['id']) ?>"
                                        class="btn-icon"
                                        title="View Customer Details"
                                        aria-label="View Customer Details">
                                        <svg viewBox="0 0 24 24"
                                            width="18"
                                            height="18"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            aria-hidden="true">
                                            <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7-10-7-10-7z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                    </a>

                                </div>
                            </td>



                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="empty-state">
                            No customers found. Add your first customer to get started.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>


<div class="pagination-wrapper">
    <?= $pager->only(['search','sort'])->links('default', 'clientflow_pagination') ?>
</div>


<?= $this->endSection() ?>