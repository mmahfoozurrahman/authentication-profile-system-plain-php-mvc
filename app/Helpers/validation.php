<?php

use App\Models\User;

function validateEmail(string $email): ?string
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return 'Valid email is required';
    }
    return null;
}

function validateUniqueEmail(string $email): ?string
{
    $userModel = new User();
    if ($userModel->findByEmail($email)) {
        return 'Email already exists';
    }
    return null;
}

function validatePassword(string $password): ?string
{
    if (strlen($password) < 6) {
        return 'Password must be at least 6 characters';
    }
    return null;
}

function validateName(string $name): ?string
{
    if (trim($name) === '') {
        return 'Name is required';
    }
    return null;
}

/**
 * Registration validation
 */
function validateRegisterForm(array $data): array
{
    $errors = [];

    if ($error = validateName($data['name'] ?? '')) {
        $errors['name'] = $error;
    }

    if ($error = validateEmail($data['email'] ?? '')) {
        $errors['email'] = $error;
    }

    if ($error = validateUniqueEmail($data['email'] ?? '')) {
        $errors['email'] = $error;
    }

    if ($error = validatePassword($data['password'] ?? '')) {
        $errors['password'] = $error;
    }

    if ($error = validatePassword($data['password_confirmation'] ?? '')) {
        $errors['password_confirmation'] = $error;
    }

    if ($data['password'] !== $data['password_confirmation']) {
        $errors['password_confirmation'] = 'Passwords do not match';
    }

    return $errors;
}

/**
 * Login validation
 */
function validateLoginForm(array $data): array
{
    $errors = [];

    if ($error = validateEmail($data['email'] ?? '')) {
        $errors['email'] = $error;
    }

    if (empty($data['password'])) {
        $errors['password'] = 'Password is required';
    }

    return $errors;
}