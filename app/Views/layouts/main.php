<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= esc($pageTitle ?? 'ClientFlow CRM') ?></title>

    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>

<body>

    <div class="app-layout">

        <!-- Left Sidebar -->
        <aside class="sidebar">

            <!-- Brand -->
            <a href="<?= site_url('dashboard') ?>" class="brand">
                Client<span>Flow</span>
            </a>

            <?php
            $menuGroups = [
                'Workspace' => [
                    'Dashboard' => 'dashboard',
                    'Activity Feed' => 'activity-feed',
                    'Calendar' => 'calendar',
                ],

                'Sales Management' => [
                    'Leads' => 'leads',
                    'Prospects' => 'prospects',
                    'Deals' => 'deals',
                    'Sales Pipeline' => 'sales-pipeline',
                    'Sales Forecasts' => 'forecasts',
                    'Quotations' => 'quotations',
                ],

                'Customer Management' => [
                    'All Customers' => 'customers',
                    'Companies' => 'companies',
                    'Contacts' => 'contacts',
                    'Customer Groups' => 'customer-groups',
                ],

                'Communication' => [
                    'Emails' => 'emails',
                    'Calls' => 'calls',
                    'Meetings' => 'meetings',
                    'Tasks' => 'tasks',
                    'Notes' => 'notes',
                ],

                'Marketing' => [
                    'Campaigns' => 'campaigns',
                    'Email Marketing' => 'email-marketing',
                    'Forms' => 'forms',
                    'Landing Pages' => 'landing-pages',
                ],

                'Customer Support' => [
                    'Support Tickets' => 'tickets',
                    'Knowledge Base' => 'knowledge-base',
                    'Customer Feedback' => 'feedback',
                    'SLA Management' => 'sla',
                ],

                'Finance' => [
                    'Invoices' => 'invoices',
                    'Payments' => 'payments',
                    'Expenses' => 'expenses',
                    'Tax Records' => 'tax-records',
                ],

                'Analytics & Reports' => [
                    'Reports' => 'reports',
                    'Sales Analytics' => 'sales-analytics',
                    'Customer Analytics' => 'customer-analytics',
                    'Export Data' => 'export-data',
                ],

                'Administration' => [
                    'Users' => 'users',
                    'Roles & Permissions' => 'roles',
                    'Teams' => 'teams',
                    'Audit Logs' => 'audit-logs',
                ],

                'Configuration' => [
                    'General Settings' => 'settings',
                    'Email Settings' => 'email-settings',
                    'Notifications' => 'notifications',
                    'Integrations' => 'integrations',
                ],
            ];

            $currentPath = trim(uri_string(), '/');
            ?>

            <!-- Dynamic Sidebar Menus -->
            <?php foreach ($menuGroups as $groupName => $items): ?>

                <?php
                $groupId = 'menu-' . md5($groupName);
                $groupIsActive = false;

                foreach ($items as $url) {
                    if (
                        $currentPath === $url ||
                        str_starts_with($currentPath, $url . '/')
                    ) {
                        $groupIsActive = true;
                        break;
                    }
                }
                ?>

                <section class="nav-group">

                    <button
                        type="button"
                        class="nav-toggle"
                        aria-expanded="<?= $groupIsActive ? 'true' : 'false' ?>"
                        aria-controls="<?= esc($groupId) ?>">
                        <span><?= esc($groupName) ?></span>
                        <span class="nav-arrow" aria-hidden="true">⌄</span>
                    </button>

                    <div
                        class="nav-submenu"
                        id="<?= esc($groupId) ?>"
                        <?= $groupIsActive ? '' : 'hidden' ?>>

                        <?php foreach ($items as $label => $url): ?>

                            <a
                                href="<?= site_url($url) ?>"
                                class="nav-link <?= $currentPath === $url ? 'active' : '' ?>">
                                <?= esc($label) ?>
                            </a>

                        <?php endforeach; ?>

                    </div>

                </section>

            <?php endforeach; ?>



            <a href="<?= site_url('logout') ?>" class="nav-link">
                <span class="nav-link-icon">↪</span>
                <span>Logout</span>
            </a>


        </aside>

        <!-- Main Page Content -->
        <main class="main-content">
            <?= $this->renderSection('content') ?>
        </main>

    </div>

    <!-- Sidebar JavaScript -->
    <script src="<?= base_url('assets/js/sidebar.js') ?>"></script>

</body>

</html>