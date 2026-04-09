<?php

declare(strict_types=1);

namespace App\Core;

use PDO;
use PDOException;

final class Database
{
    private static ?PDO $connection = null;

    public static function connect(array $config): void
    {
        if (self::$connection instanceof PDO) {
            return;
        }

        try {
            if (($config['driver'] ?? '') !== 'sqlite') {
                throw new PDOException('Only sqlite is supported in this starter.');
            }
            $databasePath = $config['database'];
            if (! file_exists($databasePath)) {
                touch($databasePath);
            }
            self::$connection = new PDO('sqlite:' . $databasePath);
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            self::$connection->exec('PRAGMA foreign_keys = ON');
        } catch (PDOException $e) {
            http_response_code(500);
            echo 'Database error: ' . e($e->getMessage());
            exit;
        }
    }

    public static function connection(): PDO
    {
        if (! self::$connection instanceof PDO) {
            throw new PDOException('Database not connected.');
        }
        return self::$connection;
    }
}
