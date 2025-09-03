<?php
/**
 * Logout Page
 * User Management System
 */

require_once 'config/auth.php';

// Logout user
Auth::logout();

// Redirect to login page
header("Location: login.php");
exit();
?>
