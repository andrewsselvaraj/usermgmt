<?php
/**
 * Create User Page
 */

require_once '../config/database.php';
require_once '../models/UserInfo.php';
require_once '../models/OrgInfo.php';
require_once '../models/RoleMaster.php';

// Initialize database connection
$database = new Database();
$db = $database->getConnection();

// Initialize models
$userInfo = new UserInfo($db);
$orgInfo = new OrgInfo($db);
$roleMaster = new RoleMaster($db);

$error_message = '';
$success_message = '';

// Get organizations and roles for dropdowns
$orgs_stmt = $orgInfo->read();
$roles_stmt = $roleMaster->read();

// Process form submission
if($_POST) {
    // Set property values
    $userInfo->pk_user_id = $userInfo->generateUserId();
    $userInfo->user_org_id = $_POST['user_org_id'];
    $userInfo->user_name = $_POST['user_name'];
    $userInfo->user_email = $_POST['user_email'];
    $userInfo->user_password = $_POST['user_password'];
    $userInfo->user_role_id = $_POST['user_role_id'];
    $userInfo->user_updated_by = $_POST['user_updated_by'];
    $userInfo->user_status = $_POST['user_status'];

    // Check if email already exists
    if($userInfo->emailExists()) {
        $error_message = "User with this email already exists.";
    } else {
        // Create the user
        if($userInfo->create()) {
            $success_message = "User created successfully.";
            // Redirect to list page after 2 seconds
            header("refresh:2;url=user_list.php");
        } else {
            $error_message = "Unable to create user.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User - User Management System</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1><i class="fas fa-users"></i> Create User</h1>
            <nav class="nav">
                <a href="../index.php" class="nav-link">Dashboard</a>
                <a href="org_list.php" class="nav-link">Organizations</a>
                <a href="role_list.php" class="nav-link">Roles</a>
                <a href="user_list.php" class="nav-link">Users</a>
            </nav>
        </header>

        <main class="main">
            <div class="page-header">
                <h2>Add New User</h2>
                <a href="user_list.php" class="btn btn-secondary">
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
                        <label for="user_org_id">Organization *</label>
                        <select id="user_org_id" name="user_org_id" class="form-control" required onchange="loadRoles()">
                            <option value="">Select Organization</option>
                            <?php while($org = $orgs_stmt->fetch(PDO::FETCH_ASSOC)): ?>
                                <option value="<?php echo $org['pk_org_id']; ?>" 
                                        <?php echo (isset($_POST['user_org_id']) && $_POST['user_org_id'] == $org['pk_org_id']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($org['org_name']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="user_name">Full Name *</label>
                        <input type="text" id="user_name" name="user_name" class="form-control" 
                               value="<?php echo isset($_POST['user_name']) ? htmlspecialchars($_POST['user_name']) : ''; ?>" 
                               required>
                    </div>

                    <div class="form-group">
                        <label for="user_email">Email Address *</label>
                        <input type="email" id="user_email" name="user_email" class="form-control" 
                               value="<?php echo isset($_POST['user_email']) ? htmlspecialchars($_POST['user_email']) : ''; ?>" 
                               required>
                    </div>

                    <div class="form-group">
                        <label for="user_password">Password *</label>
                        <input type="password" id="user_password" name="user_password" class="form-control" 
                               value="<?php echo isset($_POST['user_password']) ? htmlspecialchars($_POST['user_password']) : ''; ?>" 
                               required>
                    </div>

                    <div class="form-group">
                        <label for="user_role_id">Role *</label>
                        <select id="user_role_id" name="user_role_id" class="form-control" required>
                            <option value="">Select Role</option>
                            <?php 
                            // Reset the roles statement
                            $roles_stmt = $roleMaster->read();
                            while($role = $roles_stmt->fetch(PDO::FETCH_ASSOC)): 
                            ?>
                                <option value="<?php echo $role['pk_role_id']; ?>" 
                                        data-org="<?php echo $role['role_org_id']; ?>"
                                        <?php echo (isset($_POST['user_role_id']) && $_POST['user_role_id'] == $role['pk_role_id']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($role['role_name']); ?> (<?php echo htmlspecialchars($role['org_name']); ?>)
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="user_updated_by">Updated By *</label>
                        <input type="text" id="user_updated_by" name="user_updated_by" class="form-control" 
                               value="<?php echo isset($_POST['user_updated_by']) ? htmlspecialchars($_POST['user_updated_by']) : ''; ?>" 
                               required>
                    </div>

                    <div class="form-group">
                        <label for="user_status">Status *</label>
                        <select id="user_status" name="user_status" class="form-control" required>
                            <option value="A" <?php echo (isset($_POST['user_status']) && $_POST['user_status'] == 'A') ? 'selected' : ''; ?>>Active</option>
                            <option value="I" <?php echo (isset($_POST['user_status']) && $_POST['user_status'] == 'I') ? 'selected' : ''; ?>>Inactive</option>
                        </select>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Create User
                        </button>
                        <a href="user_list.php" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script src="../assets/js/script.js"></script>
    <script>
        function loadRoles() {
            const orgSelect = document.getElementById('user_org_id');
            const roleSelect = document.getElementById('user_role_id');
            const selectedOrg = orgSelect.value;
            
            // Clear existing options except the first one
            roleSelect.innerHTML = '<option value="">Select Role</option>';
            
            // Get all role options
            const allRoles = <?php 
                $roles_stmt = $roleMaster->read();
                $roles_data = [];
                while($role = $roles_stmt->fetch(PDO::FETCH_ASSOC)) {
                    $roles_data[] = [
                        'id' => $role['pk_role_id'],
                        'name' => $role['role_name'],
                        'org_id' => $role['role_org_id'],
                        'org_name' => $role['org_name']
                    ];
                }
                echo json_encode($roles_data);
            ?>;
            
            // Filter and add roles for selected organization
            allRoles.forEach(role => {
                if (role.org_id === selectedOrg) {
                    const option = document.createElement('option');
                    option.value = role.id;
                    option.textContent = role.name;
                    roleSelect.appendChild(option);
                }
            });
        }
    </script>
</body>
</html>
