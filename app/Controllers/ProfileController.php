<?php

namespace App\Controllers;

use App\Models\User;

class ProfileController
{
    function dashboard()
    {
        // echo 'inside dashboard';
        // exit;
        // print_r($_SESSION);
        view('profile/dashboard.php', [
            'title' => 'Dashboard',
        ]);
    }

    public function edit()
    {
        $errors = [];
        $old = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $old = $_POST;

            // Validation
            $errors = validateEditProfileForm($_POST, $_SESSION['user']['id']);

            if (!empty($errors)) {
                setFlash('error', 'Please fix the errors below and try again.');
            } else {
                $userModel = new User();

                $data = [
                    'name' => $_POST['name'],
                    'email' => $_POST['email'],
                ];

                if (!empty($_POST['password'])) {
                    $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                }

                $userModel->update($_SESSION['user']['id'], $data);

                // Update session data
                $_SESSION['user']['name'] = $data['name'];
                $_SESSION['user']['email'] = $data['email'];

                setFlash('success', 'Profile updated successfully');
                redirect("/profile/edit.php");
            }
        }

        $userModel = new User();
        $user = $userModel->find($_SESSION["user"]["id"], ['id', 'name', 'email']);

        view('profile/edit.php', [
            'title' => 'Edit Profile',
            'errors' => $errors,
            'old' => $old,
            'user' => $user,
        ]);
    }

    public function edit_password()
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Validation
            $errors = validateChangePasswordForm($_POST, $_SESSION['user']['id']);

            if (!empty($errors)) {
                setFlash('error', 'Please fix the errors below and try again.');
            } else {
                $userModel = new User();

                // Update password
                $userModel->update($_SESSION['user']['id'], [
                    'name' => $_SESSION['user']['name'],
                    'email' => $_SESSION['user']['email'],
                    'password' => password_hash($_POST['new_password'], PASSWORD_DEFAULT),
                ]);

                setFlash('success', 'Password updated successfully');
                redirect("/profile/edit_password.php");
            }
        }

        view('profile/edit_password.php', [
            'title' => 'Edit Password',
            'errors' => $errors,
        ]);
    }
}