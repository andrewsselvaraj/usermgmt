<?php
/**
 * Authentication and Session Management
 * User Management System
 */

session_start();

class Auth {
    
    /**
     * Check if user is logged in
     */
    public static function isLoggedIn() {
        return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
    }
    
    /**
     * Get current user data
     */
    public static function getUser() {
        if (self::isLoggedIn()) {
            return $_SESSION['user_data'];
        }
        return null;
    }
    
    /**
     * Get current user ID
     */
    public static function getUserId() {
        if (self::isLoggedIn()) {
            return $_SESSION['user_id'];
        }
        return null;
    }
    
    /**
     * Get current user role
     */
    public static function getUserRole() {
        if (self::isLoggedIn()) {
            return $_SESSION['user_data']['role_name'] ?? null;
        }
        return null;
    }
    
    /**
     * Get current user organization
     */
    public static function getUserOrg() {
        if (self::isLoggedIn()) {
            return $_SESSION['user_data']['org_name'] ?? null;
        }
        return null;
    }
    
    /**
     * Login user
     */
    public static function login($userData) {
        $_SESSION['user_id'] = $userData['pk_user_id'];
        $_SESSION['user_data'] = $userData;
        $_SESSION['login_time'] = time();
        return true;
    }
    
    /**
     * Logout user
     */
    public static function logout() {
        session_unset();
        session_destroy();
        return true;
    }
    
    /**
     * Require login - redirect to login page if not logged in
     */
    public static function requireLogin($redirectTo = 'login.php') {
        if (!self::isLoggedIn()) {
            header("Location: " . $redirectTo);
            exit();
        }
    }
    
    /**
     * Check if user has specific role
     */
    public static function hasRole($roleName) {
        $userRole = self::getUserRole();
        return $userRole === $roleName;
    }
    
    /**
     * Check if user is admin
     */
    public static function isAdmin() {
        return self::hasRole('Admin');
    }
    
    /**
     * Get login time
     */
    public static function getLoginTime() {
        return $_SESSION['login_time'] ?? null;
    }
    
    /**
     * Check session timeout (optional - 8 hours default)
     */
    public static function checkSessionTimeout($timeout = 28800) {
        if (self::isLoggedIn()) {
            $loginTime = self::getLoginTime();
            if ($loginTime && (time() - $loginTime) > $timeout) {
                self::logout();
                return false;
            }
        }
        return true;
    }
}
?>
