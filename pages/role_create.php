<?php
/**
 * Create Role Page
 */

require_once '../config/database.php';
require_once '../models/RoleMaster.php';
require_once '../models/OrgInfo.php';

// Initialize database connection
$database = new Database();
$db = $database->getConnection();

// Initialize models
$roleMaster = new RoleMaster($db);
$orgInfo = new OrgInfo($db);

$error_message = '';
$success_message = '';

// Get organizations for dropdown
$orgs_stmt = $orgInfo->read();

// Process form submission
if($_POST) {
    // Set property values
    $roleMaster->pk_role_id = $roleMaster->generateRoleId($_POST['role_org_id'], $_POST['role_name']);
    $roleMaster->role_org_id = $_POST['role_org_id'];
    $roleMaster->role_name = $_POST['role_name'];
    $roleMaster->role_description = $_POST['role_description'];
    $roleMaster->role_updated_by = $_POST['role_updated_by'];
    $roleMaster->role_status = $_POST['role_status'];

    // Check if role name already exists for organization
    if($roleMaster->roleExists()) {
        $error_message = "Role with this name already exists for the selected organization.";
    } else {
        // Create the role
        if($roleMaster->create()) {
            $success_message = "Role created successfully.";
            // Redirect to list page after 2 seconds
            header("refresh:2;url=role_list.php");
        } else {
            $error_message = "Unable to create role.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Role - User Management System</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1><i class="fas fa-user-tag"></i> Create Role</h1>
            <nav class="nav">
                <a href="../index.php" class="nav-link">Dashboard</a>
                <a href="org_list.php" class="nav-link">Organizations</a>
                <a href="role_list.php" class="nav-link">Roles</a>
                <a href="user_list.php" class="nav-link">Users</a>
            </nav>
        </header>

        <main class="main">
            <div class="page-header">
                <h2>Add New Role</h2>
                <a href="role_list.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>

            <?php if($error_message): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <?php if($success_message): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
                </div>
            <?php endif; ?>

            <div class="form-container">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label for="role_org_id">Organization *</label>
                        <select id="role_org_id" name="role_org_id" class="form-control" required>
                            <option value="">Select Organization</option>
                            <?php while($org = $orgs_stmt->fetch(PDO::FETCH_ASSOC)): ?>
                                <option value="<?php echo $org['pk_org_id']; ?>" 
                                        <?php echo (isset($_POST['role_org_id']) && $_POST['role_org_id'] == $org['pk_org_id']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($org['org_name']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="role_name">Role Name *</label>
                        <input type="text" id="role_name" name="role_name" class="form-control" 
                               value="<?php echo isset($_POST['role_name']) ? htmlspecialchars($_POST['role_name']) : ''; ?>" 
                               required>
                    </div>

                    <div class="form-group">
                        <label for="role_description">Description</label>
                        <textarea id="role_description" name="role_description" class="form-control" rows="3"><?php echo isset($_POST['role_description']) ? htmlspecialchars($_POST['role_description']) : ''; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="role_updated_by">Updated By *</label>
                        <input type="text" id="role_updated_by" name="role_updated_by" class="form-control" 
                               value="<?php echo isset($_POST['role_updated_by']) ? htmlspecialchars($_POST['role_updated_by']) : ''; ?>" 
                               required>
                    </div>

                    <div class="form-group">
                        <label for="role_status">Status *</label>
                        <select id="role_status" name="role_status" class="form-control" required>
                            <option value="A" <?php echo (isset($_POST['role_status']) && $_POST['role_status'] == 'A') ? 'selected' : ''; ?>>Active</option>
                            <option value="I" <?php echo (isset($_POST['role_status']) && $_POST['role_status'] == 'I') ? 'selected' : ''; ?>>Inactive</option>
                        </select>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Create Role
                        </button>
                        <a href="role_list.php" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script src="../assets/js/script.js"></script>
</body>
</html>
