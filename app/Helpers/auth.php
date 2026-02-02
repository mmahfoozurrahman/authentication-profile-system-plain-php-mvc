<?php

function auth()
{
    if (!isset($_SESSION['user'])) {
        header('Location: /login.php');
        exit;
    }
}

function currentUser(): ?array
{
    // print_r($_SESSION);
    // exit;
    return $_SESSION['user'] ?? null;
}