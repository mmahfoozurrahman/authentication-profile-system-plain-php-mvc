<?php

namespace App\Controllers;

use App\Models\User;

class AuthController
{
    public function register()
    {

        if (currentUser()) {
            redirect('/profile.php');
        }

        $errors = [];
        $old = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $old = $_POST;

            $errors = validateRegisterForm($_POST);

            if (!empty($errors)) {
                setFlash('error', 'Please fix the errors below and try again.');
            } else {

                $userModel = new User();

                $userModel->create([
                    'name' => $_POST['name'],
                    'email' => $_POST['email'],
                    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                ]);

                setFlash('success', 'Registration successful');
                redirect('/login.php');
            }
        }

        view('auth/register.php', [
            'title' => 'Register',
            'errors' => $errors,
            'old' => $old,
        ]);
    }

    public function login()
    {
        if (currentUser()) {
            redirect('/profile.php');
        }

        $errors = [];
        $old = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // echo 'login';
            // exit;
            $old = $_POST;

            // -----------------
            // Validation - One validation function (DRY)
            // -----------------
            $errors = validateLoginForm($_POST);
            //print_r($errors);

            // -----------------
            // login if error
            // -----------------
            if (!empty($errors)) {
                setFlash('error', 'Please fix the errors below and try again.');
            } else {
                $userModel = new User();
                $user = $userModel->findByEmail($_POST['email']);

                // echo $hashed = password_hash($_POST['password'], PASSWORD_DEFAULT);
                // exit;

                if (!$user || !password_verify($_POST['password'], $user['password'])) {
                    setFlash('error', 'Invalid credentials');
                    redirect('/login.php');
                }

                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                ];

                redirect('/profile.php');
            }
        }

        view('auth/login.php', [
            'title' => 'Login',
            'errors' => $errors,
            'old' => $old,
        ]);
    }
}