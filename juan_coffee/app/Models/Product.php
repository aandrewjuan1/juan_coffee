<?php

require_once base_path('app/Core/Database.php');

class Product extends Database {
    
    public function index() {
        try {
            $db = $this->connect();
            $sql = "SELECT products.*, 
                           categories.name as category_name, 
                           creator.email as creator_email, 
                           updater.email as updater_email 
                    FROM products 
                    JOIN categories ON products.category_id = categories.id
                    LEFT JOIN users AS creator ON products.created_by = creator.id
                    LEFT JOIN users AS updater ON products.updated_by = updater.id
                    ORDER BY products.created_at DESC"; // Add ordering here
            $stmt = $db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }    

    // Add a new product with created_by information
    public function add($data) {
        try {
            $db = $this->connect();
            $sql = "INSERT INTO products (name, description, price, category_id, created_by, updated_by) 
                    VALUES (:name, :description, :price, :category_id, :created_by, :updated_by)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':description', $data['description']);
            $stmt->bindParam(':price', $data['price']);
            $stmt->bindParam(':category_id', $data['category_id']);
            $stmt->bindParam(':created_by', $data['user_id']);  // Assumes user ID is passed in data
            $stmt->bindParam(':updated_by', $data['user_id']);  // Set the same user as updater initially
            $stmt->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw $e;
        }
    }

    public function update($id, $data) {
        try {
            $db = $this->connect();
            $sql = "UPDATE products 
                    SET name = :name, 
                        description = :description, 
                        price = :price, 
                        category_id = :category_id, 
                        updated_by = :updated_by,
                        updated_at = CURRENT_TIMESTAMP 
                    WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':description', $data['description']);
            $stmt->bindParam(':price', $data['price']);
            $stmt->bindParam(':category_id', $data['category_id']);
            $stmt->bindParam(':updated_by', $data['user_id']);  // Set updated_by to current user ID
            $stmt->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw $e;
        }
    }
    

    // Method to fetch all categories
    public function getCategories() {
        try {
            $db = $this->connect();
            $sql = "SELECT * FROM categories";
            $stmt = $db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle the exception (log it, rethrow it, etc.)
            error_log($e->getMessage());
            return [];
        }
    }

    // Method to delete a product
    public function delete($id) {
        try {
            $db = $this->connect();
            $sql = "DELETE FROM products WHERE id = :id";
            $stmt = $db->prepare($sql);
            
            $stmt->bindParam(':id', $id);

            $stmt->execute();
        } catch (PDOException $e) {
            // Handle the exception (log it, rethrow it, etc.)
            error_log($e->getMessage());
            throw $e;
        }
    }

    // Method to find a product by ID
    public function find($id) {
        try {
            $db = $this->connect();
            $sql = "SELECT * FROM products WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle the exception (log it, rethrow it, etc.)
            error_log($e->getMessage());
            return false;
        }
    }
}
?>
