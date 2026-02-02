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

    // Validate terms and conditions
    if (empty($data['terms'])) {
        $errors['terms'] = 'You must agree to the Terms and Conditions and Privacy Policy';
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

/**
 * Edit Profile validation
 */
function validateEditProfileForm(array $data, int $userId): array
{
    $errors = [];

    if ($error = validateName($data['name'] ?? '')) {
        $errors['name'] = $error;
    }

    if ($error = validateEmail($data['email'] ?? '')) {
        $errors['email'] = $error;
    }

    // Check if email is unique (excluding current user)
    $userModel = new User();
    $existingUser = $userModel->findByEmail($data['email'] ?? '');
    if ($existingUser && $existingUser['id'] != $userId) {
        $errors['email'] = 'Email already exists';
    }

    // Validate password only if provided
    if (!empty($data['password'])) {
        if ($error = validatePassword($data['password'])) {
            $errors['password'] = $error;
        }
    }

    return $errors;
}

/**
 * Change Password validation
 */
function validateChangePasswordForm(array $data, int $userId): array
{
    $errors = [];

    // Validate current password is provided
    if (empty($data['current_password'])) {
        $errors['current_password'] = 'Current password is required';
    } else {
        // Verify current password is correct
        $userModel = new User();
        $user = $userModel->find($userId, ['password']);
        if (!$user || !password_verify($data['current_password'], $user['password'])) {
            $errors['current_password'] = 'Current password is incorrect';
        }
    }

    // Validate new password
    if ($error = validatePassword($data['new_password'] ?? '')) {
        $errors['new_password'] = $error;
    }

    // Validate password confirmation
    if ($error = validatePassword($data['password_confirmation'] ?? '')) {
        $errors['password_confirmation'] = $error;
    }

    // Check if passwords match
    if (!empty($data['new_password']) && !empty($data['password_confirmation'])) {
        if ($data['new_password'] !== $data['password_confirmation']) {
            $errors['password_confirmation'] = 'Passwords do not match';
        }
    }

    return $errors;
}