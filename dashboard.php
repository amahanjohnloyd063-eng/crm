<?php
require_once 'config/database.php';
require_once 'includes/auth.php';
require_login();

$search = trim($_GET['search'] ?? '');
$page = max(1, intval($_GET['page'] ?? 1));
$limit = 5;
$offset = ($page - 1) * $limit;

if (!empty($search)) {
    $countStmt = $pdo->prepare("SELECT COUNT(*) FROM customers WHERE full_name LIKE ? OR email LIKE ? OR phone LIKE ?");
    $searchTerm = "%{$search}%";
    $countStmt->execute([$searchTerm, $searchTerm, $searchTerm]);
    $totalRecords = $countStmt->fetchColumn();

    $stmt = $pdo->prepare("SELECT * FROM customers WHERE full_name LIKE ? OR email LIKE ? OR phone LIKE ? ORDER BY id ASC LIMIT ? OFFSET ?");
    $stmt->bindValue(1, $searchTerm, PDO::PARAM_STR);
    $stmt->bindValue(2, $searchTerm, PDO::PARAM_STR);
    $stmt->bindValue(3, $searchTerm, PDO::PARAM_STR);
    $stmt->bindValue(4, $limit, PDO::PARAM_INT);
    $stmt->bindValue(5, $offset, PDO::PARAM_INT);
    $stmt->execute();
    $customers = $stmt->fetchAll();
} else {
    $countStmt = $pdo->query("SELECT COUNT(*) FROM customers");
    $totalRecords = $countStmt->fetchColumn();

    $stmt = $pdo->prepare("SELECT * FROM customers ORDER BY id ASC LIMIT ? OFFSET ?");
    $stmt->bindValue(1, $limit, PDO::PARAM_INT);
    $stmt->bindValue(2, $offset, PDO::PARAM_INT);
    $stmt->execute();
    $customers = $stmt->fetchAll();
}

$totalPages = max(1, ceil($totalRecords / $limit));

include 'includes/header.php';
include 'includes/sidebar.php';
?>

<div class="main-content">
    <header class="top-navbar">
        <div class="user-profile">
            <span>👤</span>
            <span><?= htmlspecialchars($_SESSION['username'] ?? 'Admin') ?></span>
        </div>
    </header>

    <div class="content-body">
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">
                <?php 
                    if ($_GET['success'] == 'added') echo 'Customer successfully added.';
                    elseif ($_GET['success'] == 'updated') echo 'Customer successfully updated.';
                    elseif ($_GET['success'] == 'deleted') echo 'Customer successfully deleted.';
                ?>
            </div>
        <?php endif; ?>

        <div class="page-header-row">
            <h1 class="page-title">Customer List</h1>
            <div style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
                <a href="add_customer.php" class="btn-primary">+ Add Customer</a>
                <form action="dashboard.php" method="GET" class="search-form">
                    <input type="text" name="search" class="search-input" placeholder="Search by name, email, or phone..." value="<?= htmlspecialchars($search) ?>">
                    <?php if (!empty($search)): ?>
                        <a href="dashboard.php" class="btn-clear" title="Clear Search">✕ Clear</a>
                    <?php endif; ?>
                    <button type="submit" class="search-btn">Search</button>
                </form>
            </div>
        </div>

        <div class="table-card">
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($customers) > 0): ?>
                            <?php foreach ($customers as $c): ?>
                                <tr>
                                    <td><?= $c['id'] ?></td>
                                    <td><?= htmlspecialchars($c['full_name']) ?></td>
                                    <td><?= htmlspecialchars($c['email']) ?></td>
                                    <td><?= htmlspecialchars($c['phone']) ?></td>
                                    <td><?= htmlspecialchars($c['address']) ?></td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="view_customer.php?id=<?= $c['id'] ?>" class="btn-sm btn-view">View</a>
                                            <a href="edit_customer.php?id=<?= $c['id'] ?>" class="btn-sm btn-edit">Edit</a>
                                            <a href="delete_customer.php?id=<?= $c['id'] ?>" class="btn-sm btn-delete" onclick="return confirm('Are you sure you want to delete this customer?');">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 3rem; color: var(--text-muted);">
                                    No customers yet. Click Add Customer to get started.<br><br>
                                    <a href="add_customer.php" class="btn-primary" style="font-size: 0.85rem;">+ Add Customer</a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <div class="table-footer">
                <div>
                    Showing <?= count($customers) > 0 ? $offset + 1 : 0 ?> to <?= min($offset + $limit, $totalRecords) ?> of <?= $totalRecords ?> customers
                </div>
                <?php if ($totalPages > 1): ?>
                    <div class="pagination">
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <a href="dashboard.php?page=<?= $i ?><?= !empty($search) ? '&search=' . urlencode($search) : '' ?>" class="page-link <?= $i === $page ? 'active' : '' ?>"><?= $i ?></a>
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>