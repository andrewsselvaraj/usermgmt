<?php
/**
 * Role Master Model
 * Handles CRUD operations for role_master table
 */

require_once __DIR__ . '/../config/database.php';

class RoleMaster {
    private $conn;
    private $table_name = "role_master";

    public $pk_role_id;
    public $role_org_id;
    public $role_name;
    public $role_description;
    public $role_updated_by;
    public $role_status;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create new role
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET pk_role_id=:pk_role_id, role_org_id=:role_org_id, role_name=:role_name, 
                      role_description=:role_description, role_updated_by=:role_updated_by, role_status=:role_status";

        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->pk_role_id = htmlspecialchars(strip_tags($this->pk_role_id));
        $this->role_org_id = htmlspecialchars(strip_tags($this->role_org_id));
        $this->role_name = htmlspecialchars(strip_tags($this->role_name));
        $this->role_description = htmlspecialchars(strip_tags($this->role_description));
        $this->role_updated_by = htmlspecialchars(strip_tags($this->role_updated_by));
        $this->role_status = htmlspecialchars(strip_tags($this->role_status));

        // Bind values
        $stmt->bindParam(":pk_role_id", $this->pk_role_id);
        $stmt->bindParam(":role_org_id", $this->role_org_id);
        $stmt->bindParam(":role_name", $this->role_name);
        $stmt->bindParam(":role_description", $this->role_description);
        $stmt->bindParam(":role_updated_by", $this->role_updated_by);
        $stmt->bindParam(":role_status", $this->role_status);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Read all roles
    public function read() {
        $query = "SELECT r.*, o.org_name 
                  FROM " . $this->table_name . " r 
                  LEFT JOIN org_info o ON r.role_org_id = o.pk_org_id 
                  ORDER BY r.role_updated_on DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Read roles by organization
    public function readByOrg($org_id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE role_org_id = ? AND role_status = 'A' ORDER BY role_name";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $org_id);
        $stmt->execute();
        return $stmt;
    }

    // Read single role
    public function readOne() {
        $query = "SELECT r.*, o.org_name 
                  FROM " . $this->table_name . " r 
                  LEFT JOIN org_info o ON r.role_org_id = o.pk_org_id 
                  WHERE r.pk_role_id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->pk_role_id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $this->role_org_id = $row['role_org_id'];
            $this->role_name = $row['role_name'];
            $this->role_description = $row['role_description'];
            $this->role_updated_by = $row['role_updated_by'];
            $this->role_status = $row['role_status'];
            return true;
        }
        return false;
    }

    // Update role
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET role_name=:role_name, role_description=:role_description, 
                      role_updated_by=:role_updated_by, role_status=:role_status 
                  WHERE pk_role_id=:pk_role_id";

        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->role_name = htmlspecialchars(strip_tags($this->role_name));
        $this->role_description = htmlspecialchars(strip_tags($this->role_description));
        $this->role_updated_by = htmlspecialchars(strip_tags($this->role_updated_by));
        $this->role_status = htmlspecialchars(strip_tags($this->role_status));
        $this->pk_role_id = htmlspecialchars(strip_tags($this->pk_role_id));

        // Bind values
        $stmt->bindParam(":role_name", $this->role_name);
        $stmt->bindParam(":role_description", $this->role_description);
        $stmt->bindParam(":role_updated_by", $this->role_updated_by);
        $stmt->bindParam(":role_status", $this->role_status);
        $stmt->bindParam(":pk_role_id", $this->pk_role_id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Delete role
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE pk_role_id = ?";
        $stmt = $this->conn->prepare($query);
        $this->pk_role_id = htmlspecialchars(strip_tags($this->pk_role_id));
        $stmt->bindParam(1, $this->pk_role_id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Check if role name exists for organization
    public function roleExists() {
        $query = "SELECT pk_role_id FROM " . $this->table_name . " 
                  WHERE role_name = ? AND role_org_id = ? AND pk_role_id != ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->role_name);
        $stmt->bindParam(2, $this->role_org_id);
        $stmt->bindParam(3, $this->pk_role_id);
        $stmt->execute();
        
        if($stmt->rowCount() > 0) {
            return true;
        }
        return false;
    }

    // Generate unique role ID
    public function generateRoleId($org_id, $role_name) {
        $prefix = strtolower(str_replace(' ', '_', $role_name));
        return $prefix . '_' . substr($org_id, -6) . '_' . uniqid();
    }
}
?>
