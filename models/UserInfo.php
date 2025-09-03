<?php
/**
 * User Information Model
 * Handles CRUD operations for user_info table
 */

require_once __DIR__ . '/../config/database.php';

class UserInfo {
    private $conn;
    private $table_name = "user_info";

    public $pk_user_id;
    public $user_org_id;
    public $user_name;
    public $user_email;
    public $user_password;
    public $user_role_id;
    public $user_updated_by;
    public $user_status;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create new user
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET pk_user_id=:pk_user_id, user_org_id=:user_org_id, user_name=:user_name, 
                      user_email=:user_email, user_password=:user_password, user_role_id=:user_role_id, 
                      user_updated_by=:user_updated_by, user_status=:user_status";

        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->pk_user_id = htmlspecialchars(strip_tags($this->pk_user_id));
        $this->user_org_id = htmlspecialchars(strip_tags($this->user_org_id));
        $this->user_name = htmlspecialchars(strip_tags($this->user_name));
        $this->user_email = htmlspecialchars(strip_tags($this->user_email));
        $this->user_password = htmlspecialchars(strip_tags($this->user_password));
        $this->user_role_id = htmlspecialchars(strip_tags($this->user_role_id));
        $this->user_updated_by = htmlspecialchars(strip_tags($this->user_updated_by));
        $this->user_status = htmlspecialchars(strip_tags($this->user_status));

        // Bind values
        $stmt->bindParam(":pk_user_id", $this->pk_user_id);
        $stmt->bindParam(":user_org_id", $this->user_org_id);
        $stmt->bindParam(":user_name", $this->user_name);
        $stmt->bindParam(":user_email", $this->user_email);
        $stmt->bindParam(":user_password", $this->user_password);
        $stmt->bindParam(":user_role_id", $this->user_role_id);
        $stmt->bindParam(":user_updated_by", $this->user_updated_by);
        $stmt->bindParam(":user_status", $this->user_status);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Read all users with organization and role details
    public function read() {
        $query = "SELECT u.*, o.org_name, r.role_name 
                  FROM " . $this->table_name . " u 
                  LEFT JOIN org_info o ON u.user_org_id = o.pk_org_id 
                  LEFT JOIN role_master r ON u.user_role_id = r.pk_role_id 
                  ORDER BY u.user_updated_date_time DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Read users by organization
    public function readByOrg($org_id) {
        $query = "SELECT u.*, o.org_name, r.role_name 
                  FROM " . $this->table_name . " u 
                  LEFT JOIN org_info o ON u.user_org_id = o.pk_org_id 
                  LEFT JOIN role_master r ON u.user_role_id = r.pk_role_id 
                  WHERE u.user_org_id = ? 
                  ORDER BY u.user_updated_date_time DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $org_id);
        $stmt->execute();
        return $stmt;
    }

    // Read single user
    public function readOne() {
        $query = "SELECT u.*, o.org_name, r.role_name 
                  FROM " . $this->table_name . " u 
                  LEFT JOIN org_info o ON u.user_org_id = o.pk_org_id 
                  LEFT JOIN role_master r ON u.user_role_id = r.pk_role_id 
                  WHERE u.pk_user_id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->pk_user_id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $this->user_org_id = $row['user_org_id'];
            $this->user_name = $row['user_name'];
            $this->user_email = $row['user_email'];
            $this->user_password = $row['user_password'];
            $this->user_role_id = $row['user_role_id'];
            $this->user_updated_by = $row['user_updated_by'];
            $this->user_status = $row['user_status'];
            return true;
        }
        return false;
    }

    // Update user
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET user_name=:user_name, user_email=:user_email, user_password=:user_password, 
                      user_role_id=:user_role_id, user_updated_by=:user_updated_by, user_status=:user_status 
                  WHERE pk_user_id=:pk_user_id";

        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->user_name = htmlspecialchars(strip_tags($this->user_name));
        $this->user_email = htmlspecialchars(strip_tags($this->user_email));
        $this->user_password = htmlspecialchars(strip_tags($this->user_password));
        $this->user_role_id = htmlspecialchars(strip_tags($this->user_role_id));
        $this->user_updated_by = htmlspecialchars(strip_tags($this->user_updated_by));
        $this->user_status = htmlspecialchars(strip_tags($this->user_status));
        $this->pk_user_id = htmlspecialchars(strip_tags($this->pk_user_id));

        // Bind values
        $stmt->bindParam(":user_name", $this->user_name);
        $stmt->bindParam(":user_email", $this->user_email);
        $stmt->bindParam(":user_password", $this->user_password);
        $stmt->bindParam(":user_role_id", $this->user_role_id);
        $stmt->bindParam(":user_updated_by", $this->user_updated_by);
        $stmt->bindParam(":user_status", $this->user_status);
        $stmt->bindParam(":pk_user_id", $this->pk_user_id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Delete user
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE pk_user_id = ?";
        $stmt = $this->conn->prepare($query);
        $this->pk_user_id = htmlspecialchars(strip_tags($this->pk_user_id));
        $stmt->bindParam(1, $this->pk_user_id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Check if email exists
    public function emailExists() {
        $query = "SELECT pk_user_id FROM " . $this->table_name . " WHERE user_email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->user_email);
        $stmt->execute();
        
        if($stmt->rowCount() > 0) {
            return true;
        }
        return false;
    }

    // Generate unique user ID
    public function generateUserId() {
        return uniqid();
    }

    // User login verification
    public function login($email, $password) {
        $query = "SELECT u.*, o.org_name, r.role_name 
                  FROM " . $this->table_name . " u 
                  LEFT JOIN org_info o ON u.user_org_id = o.pk_org_id 
                  LEFT JOIN role_master r ON u.user_role_id = r.pk_role_id 
                  WHERE u.user_email = ? AND u.user_password = ? AND u.user_status = 'A'";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $email);
        $stmt->bindParam(2, $password);
        $stmt->execute();
        
        if($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }
}
?>
