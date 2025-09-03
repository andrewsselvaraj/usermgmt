<?php
/**
 * User Management System - Main Dashboard
 */

require_once 'config/database.php';
require_once 'models/OrgInfo.php';
require_once 'models/RoleMaster.php';
require_once 'models/UserInfo.php';

// Initialize database connection
$database = new Database();
$db = $database->getConnection();

// Initialize models
$orgInfo = new OrgInfo($db);
$roleMaster = new RoleMaster($db);
$userInfo = new UserInfo($db);

// Get counts for dashboard
$org_count = $orgInfo->read()->rowCount();
$role_count = $roleMaster->read()->rowCount();
$user_count = $userInfo->read()->rowCount();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management System</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1><i class="fas fa-users"></i> User Management System</h1>
            <nav class="nav">
                <a href="index.php" class="nav-link active">Dashboard</a>
                <a href="pages/org_list.php" class="nav-link">Organizations</a>
                <a href="pages/role_list.php" class="nav-link">Roles</a>
                <a href="pages/user_list.php" class="nav-link">Users</a>
            </nav>
        </header>

        <main class="main">
            <div class="dashboard">
                <h2>Dashboard Overview</h2>
                
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="stat-content">
                            <h3><?php echo $org_count; ?></h3>
                            <p>Organizations</p>
                        </div>
                        <a href="pages/org_list.php" class="stat-link">View All</a>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-user-tag"></i>
                        </div>
                        <div class="stat-content">
                            <h3><?php echo $role_count; ?></h3>
                            <p>Roles</p>
                        </div>
                        <a href="pages/role_list.php" class="stat-link">View All</a>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-content">
                            <h3><?php echo $user_count; ?></h3>
                            <p>Users</p>
                        </div>
                        <a href="pages/user_list.php" class="stat-link">View All</a>
                    </div>
                </div>

                <div class="quick-actions">
                    <h3>Quick Actions</h3>
                    <div class="action-buttons">
                        <a href="pages/org_create.php" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add Organization
                        </a>
                        <a href="pages/role_create.php" class="btn btn-secondary">
                            <i class="fas fa-plus"></i> Add Role
                        </a>
                        <a href="pages/user_create.php" class="btn btn-success">
                            <i class="fas fa-plus"></i> Add User
                        </a>
                    </div>
                </div>

                <div class="recent-activity">
                    <h3>Recent Activity</h3>
                    <div class="activity-list">
                        <div class="activity-item">
                            <i class="fas fa-building"></i>
                            <span>Latest organizations and users are displayed here</span>
                            <small>System ready for use</small>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer class="footer">
            <p>&copy; 2025 User Management System. All rights reserved.</p>
        </footer>
    </div>

    <script src="assets/js/script.js"></script>
</body>
</html>
