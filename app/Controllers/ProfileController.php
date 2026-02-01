<?php

namespace App\Controllers;

use App\Models\User;

class ProfileController
{
    function dashboard()
    {
        view('profile/dashboard.php', [
            'title' => 'Dashboard',
        ]);
    }

    public function profile()
    {
        auth();

        $userModel = new User();

        $data = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
        ];

        if (!empty($_POST['password'])) {
            $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        }

        $userModel->update($_SESSION['user']['id'], $data);

        $_SESSION['user']['name'] = $data['name'];
        $_SESSION['user']['email'] = $data['email'];

        header('Location: /profile.php');
    }
}