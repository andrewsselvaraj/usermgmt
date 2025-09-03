<?php
/**
 * Organization Information Model
 * Handles CRUD operations for org_info table
 */

require_once __DIR__ . '/../config/database.php';

class OrgInfo {
    private $conn;
    private $table_name = "org_info";

    public $pk_org_id;
    public $org_name;
    public $org_email;
    public $org_password;
    public $org_updated_by;
    public $org_status;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create new organization
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET pk_org_id=:pk_org_id, org_name=:org_name, org_email=:org_email, 
                      org_password=:org_password, org_updated_by=:org_updated_by, org_status=:org_status";

        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->pk_org_id = htmlspecialchars(strip_tags($this->pk_org_id));
        $this->org_name = htmlspecialchars(strip_tags($this->org_name));
        $this->org_email = htmlspecialchars(strip_tags($this->org_email));
        $this->org_password = htmlspecialchars(strip_tags($this->org_password));
        $this->org_updated_by = htmlspecialchars(strip_tags($this->org_updated_by));
        $this->org_status = htmlspecialchars(strip_tags($this->org_status));

        // Bind values
        $stmt->bindParam(":pk_org_id", $this->pk_org_id);
        $stmt->bindParam(":org_name", $this->org_name);
        $stmt->bindParam(":org_email", $this->org_email);
        $stmt->bindParam(":org_password", $this->org_password);
        $stmt->bindParam(":org_updated_by", $this->org_updated_by);
        $stmt->bindParam(":org_status", $this->org_status);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Read all organizations
    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY org_updated_on DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Read single organization
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE pk_org_id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->pk_org_id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $this->org_name = $row['org_name'];
            $this->org_email = $row['org_email'];
            $this->org_password = $row['org_password'];
            $this->org_updated_by = $row['org_updated_by'];
            $this->org_status = $row['org_status'];
            return true;
        }
        return false;
    }

    // Update organization
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET org_name=:org_name, org_email=:org_email, org_password=:org_password, 
                      org_updated_by=:org_updated_by, org_status=:org_status 
                  WHERE pk_org_id=:pk_org_id";

        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->org_name = htmlspecialchars(strip_tags($this->org_name));
        $this->org_email = htmlspecialchars(strip_tags($this->org_email));
        $this->org_password = htmlspecialchars(strip_tags($this->org_password));
        $this->org_updated_by = htmlspecialchars(strip_tags($this->org_updated_by));
        $this->org_status = htmlspecialchars(strip_tags($this->org_status));
        $this->pk_org_id = htmlspecialchars(strip_tags($this->pk_org_id));

        // Bind values
        $stmt->bindParam(":org_name", $this->org_name);
        $stmt->bindParam(":org_email", $this->org_email);
        $stmt->bindParam(":org_password", $this->org_password);
        $stmt->bindParam(":org_updated_by", $this->org_updated_by);
        $stmt->bindParam(":org_status", $this->org_status);
        $stmt->bindParam(":pk_org_id", $this->pk_org_id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Delete organization
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE pk_org_id = ?";
        $stmt = $this->conn->prepare($query);
        $this->pk_org_id = htmlspecialchars(strip_tags($this->pk_org_id));
        $stmt->bindParam(1, $this->pk_org_id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Check if email exists
    public function emailExists() {
        $query = "SELECT pk_org_id FROM " . $this->table_name . " WHERE org_email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->org_email);
        $stmt->execute();
        
        if($stmt->rowCount() > 0) {
            return true;
        }
        return false;
    }

    // Generate unique organization ID
    public function generateOrgId() {
        return uniqid();
    }
}
?>
