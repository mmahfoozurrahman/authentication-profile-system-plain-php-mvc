<?php

namespace App\Models;

use App\Core\Database;

class User
{
    private \PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO users (name, email, password)
             VALUES (:name, :email, :password)"
        );

        return $stmt->execute([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    }

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM users WHERE email = :email LIMIT 1"
        );
        $stmt->execute(['email' => $email]);

        return $stmt->fetch() ?: null;
    }

    public function find(int $id, array $fields = ['*']): ?array
    {
        $columns = implode(', ', $fields);
        $stmt = $this->db->prepare(
            "SELECT {$columns} FROM users WHERE id = :id LIMIT 1"
        );
        $stmt->execute(['id' => $id]);

        return $stmt->fetch() ?: null;
    }

    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE users SET name = :name, email = :email";

        if (!empty($data['password'])) {
            $sql .= ", password = :password";
        }

        $sql .= " WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        $params = [
            'id' => $id,
            'name' => $data['name'],
            'email' => $data['email'],
        ];

        if (!empty($data['password'])) {
            $params['password'] = $data['password'];
        }

        return $stmt->execute($params);
    }
}