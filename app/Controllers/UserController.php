<?php
require_once base_path('app/Models/User.php');
require_once base_path('app/Core/Session.php'); 
require_once base_path('app/Core/Validator.php'); 

class UserController {
    
    public function loginPage() {
        return view('login/create.view.php');
    }

    public function registerPage() {
        return view('registration/create.view.php');
    }

    public function register() {
        $errors = [];
    
        // Retrieve input values and trim whitespace
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $password_confirmation = trim($_POST['password_confirmation']);
    
        // Validate email
        if (empty($email)) {
            $errors['email'] = 'Email is required.';
        } elseif (!Validator::email($email)) {
            $errors['email'] = 'Invalid email format.';
        }
    
        // Validate password
        if (empty($password)) {
            $errors['password'] = 'Password is required.';
        } elseif (!Validator::string($password, 6)) {
            $errors['password'] = 'Password must be at least 6 characters long.';
        }
    
        // Validate password confirmation
        if (empty($password_confirmation)) {
            $errors['password_confirmation'] = 'Please repeat the password.';
        } elseif ($password !== $password_confirmation) {
            $errors['password_confirmation'] = 'Passwords do not match.';
        }
    
        // Store errors in session if they exist
        if (!empty($errors)) {
            Session::flash('errors', $errors);
            return redirect('/juan_coffee/register'); // Redirect to re-render the registration form
        }
    
        // Register user if there are no errors
        $userModel = new User();
        $response = $userModel->register($email, $password);
    
        if (strpos($response, 'successfully') !== false) {
            redirect('/juan_coffee/products'); // Redirect to login page on successful registration
        } else {
            Session::flash('errors', ['email' => $response]); // Flash error message if registration fails
            redirect('/juan_coffee/register'); // Redirect back to form
        }
    }
    

    public function login() {
        $errors = [];
    
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
    
        if (empty($email)) {
            $errors['email'] = 'Email is required.';
        } elseif (!Validator::email($email)) {
            $errors['email'] = 'Invalid email format.';
        }
    
        if (empty($password)) {
            $errors['password'] = 'Password is required.';
        } 
    
        if (empty($errors)) {
            $userModel = new User();
            $response = $userModel->login($email, $password);
    
            if ($response === "Login successful!") {
                // Get the user ID based on email and store it in the session
                $userId = $userModel->getIdByEmail($email);
                Session::put('user_id', $userId); // Store user ID in session
                Session::put('user', $email); // Store email in session
                
                return redirect('/juan_coffee/products');
            } else {
                Session::flash('login_error', $response);
            }
        } else {
            Session::flash('errors', $errors); // Flash validation errors
        }
    
        return redirect('/juan_coffee/'); // Redirect to login page
    }
    

    public function logout() {
        Session::destroy();
        redirect('/juan_coffee/');
    }
}
