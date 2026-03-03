<?php
// app/controllers/AuthController.php

class AuthController {

    private User $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function login(): void {
        $errors = [];
        $email  = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email    = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            // Server-side validation
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Please enter a valid email address.';
            }
            if (strlen($password) < 6) {
                $errors[] = 'Password must be at least 6 characters.';
            }

            if (empty($errors)) {
                $user = $this->userModel->findByEmail($email);
                if ($user && $this->userModel->verifyPassword($password, $user['password_hash'])) {
                    $_SESSION['user_id']   = $user['id'];
                    $_SESSION['user_name'] = $user['full_name'];
                    $_SESSION['user_role'] = $user['role'];
                    header('Location: index.php?route=dashboard');
                    exit;
                } else {
                    $errors[] = 'Invalid email or password.';
                }
            }
        }

        // If already logged in, redirect
        if (!empty($_SESSION['user_id'])) {
            header('Location: index.php?route=dashboard');
            exit;
        }

        require __DIR__ . '/../views/auth/login.php';
    }

    public function logout(): void {
        session_destroy();
        header('Location: index.php?route=login');
        exit;
    }
}
