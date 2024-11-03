<?php

require_once base_path('app/Core/Database.php');

class User extends Database {
    
    public function register($email, $password) {
        // Hash the password before storing it
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        // SQL to check if email already exists
        $checkEmailSql = "SELECT COUNT(*) FROM users WHERE email = :email";
    
        // SQL to insert a new user
        $insertSql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    
        try {
            // Connect to the database
            $dbh = $this->connect();
    
            // Prepare and execute the statement to check email existence
            $checkStmt = $dbh->prepare($checkEmailSql);
            $checkStmt->bindParam(':email', $email);
            $checkStmt->execute();
            
            // If email exists, return an error message
            if ($checkStmt->fetchColumn() > 0) {
                return "This email is already registered.";
            }
    
            // Prepare the insert statement
            $insertStmt = $dbh->prepare($insertSql);
    
            // Bind parameters to the insert statement
            $insertStmt->bindParam(':email', $email);
            $insertStmt->bindParam(':password', $hashedPassword);
    
            // Execute the insert statement
            if ($insertStmt->execute()) {
                return "User registered successfully!";
            } else {
                return "Failed to register user.";
            }
        } catch (PDOException $e) {
            // Handle error
            return "Error: " . $e->getMessage();
        }
    }

    public function login($email, $password) {
        // Prepare the SQL statement to retrieve the user
        $sql = "SELECT * FROM users WHERE email = :email";
        
        try {
            // Connect to the database
            $dbh = $this->connect();
            
            // Prepare the statement
            $stmt = $dbh->prepare($sql);
            
            // Bind parameters
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            
            // Fetch user data
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Verify the password
            if ($user && password_verify($password, $user['password'])) {
                // Successful login, you can set session variables here
                return "Login successful!";
            } else {
                return "Invalid email or password.";
            }
        } catch (PDOException $e) {
            // Handle error
            return "Error: " . $e->getMessage();
        }
    }

    public function getIdByEmail($email) {
        // SQL to retrieve the user ID based on the email
        $sql = "SELECT id FROM users WHERE email = :email";
    
        try {
            // Connect to the database
            $dbh = $this->connect();
    
            // Prepare the statement
            $stmt = $dbh->prepare($sql);
    
            // Bind the email parameter
            $stmt->bindParam(':email', $email);
            
            // Execute the query
            $stmt->execute();
    
            // Fetch the user ID
            $userId = $stmt->fetchColumn();
            
            // Return the ID or null if not found
            return $userId ? $userId : null;
            
        } catch (PDOException $e) {
            // Handle error
            return "Error: " . $e->getMessage();
        }
    }
}
