<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/core/Helpers.php';

use App\Controllers\AuthController;

if (currentUser()) {
    redirect('/profile/dashboard.php');
}

(new AuthController())->register();