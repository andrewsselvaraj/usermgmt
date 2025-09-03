<?php
/**
 * Edit Organization Page
 */

require_once '../config/database.php';
require_once '../config/auth.php';
require_once '../models/OrgInfo.php';

// Require login
Auth::requireLogin('../login.php');

// Initialize database connection
$database = new Database();
$db = $database->getConnection();

// Initialize model
$orgInfo = new OrgInfo($db);

$error_message = '';
$success_message = '';

// Get organization ID from URL
$org_id = isset($_GET['id']) ? $_GET['id'] : '';

if(empty($org_id)) {
    header("Location: org_list.php");
    exit();
}

// Set organization ID and read organization data
$orgInfo->pk_org_id = $org_id;
if(!$orgInfo->readOne()) {
    header("Location: org_list.php");
    exit();
}

// Process form submission
if($_POST) {
    // Set property values
    $orgInfo->org_name = $_POST['org_name'];
    $orgInfo->org_email = $_POST['org_email'];
    $orgInfo->org_password = $_POST['org_password'];
    $orgInfo->org_updated_by = $_POST['org_updated_by'];
    $orgInfo->org_status = $_POST['org_status'];

    // Check if email already exists (excluding current organization)
    $check_org = new OrgInfo($db);
    $check_org->org_email = $_POST['org_email'];
    if($check_org->emailExists() && $check_org->pk_org_id != $org_id) {
        $error_message = "Organization with this email already exists.";
    } else {
        // Update the organization
        if($orgInfo->update()) {
            $success_message = "Organization updated successfully.";
            // Redirect to list page after 2 seconds
            header("refresh:2;url=org_list.php");
        } else {
            $error_message = "Unable to update organization.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Organization - User Management System</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1><i class="fas fa-building"></i> Edit Organization</h1>
            <nav class="nav">
                <a href="../index.php" class="nav-link">Dashboard</a>
                <a href="org_list.php" class="nav-link">Organizations</a>
                <a href="role_list.php" class="nav-link">Roles</a>
                <a href="user_list.php" class="nav-link">Users</a>
            </nav>
        </header>

        <main class="main">
            <div class="page-header">
                <h2>Edit Organization</h2>
                <a href="org_list.php" class="btn btn-secondary">
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
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=<?php echo $org_id; ?>" method="post">
                    <div class="form-group">
                        <label for="org_id">Organization ID</label>
                        <input type="text" id="org_id" class="form-control" 
                               value="<?php echo htmlspecialchars($orgInfo->pk_org_id); ?>" 
                               readonly>
                    </div>

                    <div class="form-group">
                        <label for="org_name">Organization Name *</label>
                        <input type="text" id="org_name" name="org_name" class="form-control" 
                               value="<?php echo htmlspecialchars($orgInfo->org_name); ?>" 
                               required>
                    </div>

                    <div class="form-group">
                        <label for="org_email">Email Address *</label>
                        <input type="email" id="org_email" name="org_email" class="form-control" 
                               value="<?php echo htmlspecialchars($orgInfo->org_email); ?>" 
                               required>
                    </div>

                    <div class="form-group">
                        <label for="org_password">Password *</label>
                        <input type="password" id="org_password" name="org_password" class="form-control" 
                               value="<?php echo htmlspecialchars($orgInfo->org_password); ?>" 
                               required>
                    </div>

                    <div class="form-group">
                        <label for="org_updated_by">Updated By *</label>
                        <input type="text" id="org_updated_by" name="org_updated_by" class="form-control" 
                               value="<?php echo htmlspecialchars($orgInfo->org_updated_by); ?>" 
                               required>
                    </div>

                    <div class="form-group">
                        <label for="org_status">Status *</label>
                        <select id="org_status" name="org_status" class="form-control" required>
                            <option value="A" <?php echo ($orgInfo->org_status == 'A') ? 'selected' : ''; ?>>Active</option>
                            <option value="I" <?php echo ($orgInfo->org_status == 'I') ? 'selected' : ''; ?>>Inactive</option>
                        </select>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Organization
                        </button>
                        <a href="org_list.php" class="btn btn-secondary">
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
