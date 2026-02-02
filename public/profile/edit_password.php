<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../app/core/Helpers.php';

use App\Controllers\ProfileController;

if (!currentUser()) {
    redirect('/login.php');
}

(new ProfileController())->edit_password();