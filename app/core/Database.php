<?php

namespace App\Core;

class Database
{
    private static ?\PDO $instance = null;

    public static function connect(): \PDO
    {
        if (!self::$instance) {
            self::$instance = new \PDO(
                "mysql:host=localhost;dbname=pp-auth-profile;charset=utf8mb4",
                "root",
                "root123",
                [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                ]
            );
        }

        return self::$instance;
    }
}