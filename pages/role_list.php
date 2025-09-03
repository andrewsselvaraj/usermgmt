<?php
/**
 * Role List Page
 */

require_once '../config/database.php';
require_once '../config/auth.php';
require_once '../models/RoleMaster.php';
require_once '../models/OrgInfo.php';

// Require login
Auth::requireLogin('../login.php');

// Initialize database connection
$database = new Database();
$db = $database->getConnection();

// Initialize models
$roleMaster = new RoleMaster($db);
$orgInfo = new OrgInfo($db);

// Handle delete operation
if(isset($_POST['delete_id'])) {
    $roleMaster->pk_role_id = $_POST['delete_id'];
    if($roleMaster->delete()) {
        $success_message = "Role deleted successfully.";
    } else {
        $error_message = "Unable to delete role.";
    }
}

// Read roles
$stmt = $roleMaster->read();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roles - User Management System</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1><i class="fas fa-user-tag"></i> Roles</h1>
            <nav class="nav">
                <a href="../index.php" class="nav-link">Dashboard</a>
                <a href="org_list.php" class="nav-link">Organizations</a>
                <a href="role_list.php" class="nav-link active">Roles</a>
                <a href="user_list.php" class="nav-link">Users</a>
            </nav>
        </header>

        <main class="main">
            <div class="page-header">
                <h2>Role Management</h2>
                <a href="role_create.php" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add New Role
                </a>
            </div>

            <?php if(isset($success_message)): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
                </div>
            <?php endif; ?>

            <?php if(isset($error_message)): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <div class="table-container">
                <table class="table" id="rolesTable">
                    <thead>
                        <tr>
                            <th>Role ID</th>
                            <th>Role Name</th>
                            <th>Organization</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Updated By</th>
                            <th>Updated On</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['pk_role_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['role_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['org_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['role_description']); ?></td>
                            <td>
                                <span class="status status-<?php echo strtolower($row['role_status']); ?>">
                                    <?php echo $row['role_status'] == 'A' ? 'Active' : 'Inactive'; ?>
                                </span>
                            </td>
                            <td><?php echo htmlspecialchars($row['role_updated_by']); ?></td>
                            <td><?php echo date('M d, Y H:i', strtotime($row['role_updated_on'])); ?></td>
                            <td class="actions">
                                <a href="role_edit.php?id=<?php echo $row['pk_role_id']; ?>" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button onclick="confirmDelete('<?php echo $row['pk_role_id']; ?>', '<?php echo htmlspecialchars($row['role_name']); ?>')" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <h3>Confirm Delete</h3>
            <p>Are you sure you want to delete role "<span id="roleName"></span>"?</p>
            <div class="modal-actions">
                <form method="POST" style="display: inline;">
                    <input type="hidden" name="delete_id" id="deleteId">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
                <button onclick="closeModal()" class="btn btn-secondary">Cancel</button>
            </div>
        </div>
    </div>

    <script src="../assets/js/script.js"></script>
    <script>
        function confirmDelete(id, name) {
            document.getElementById('deleteId').value = id;
            document.getElementById('roleName').textContent = name;
            document.getElementById('deleteModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('deleteModal').style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('deleteModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>
</body>
</html>
