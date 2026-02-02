<?php
// session_start();
require_once '../app/core/Helpers.php';

session_unset();
session_destroy();

// header('Location: /login.php');
redirect("/");