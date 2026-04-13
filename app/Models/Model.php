<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

abstract class Model
{
    protected PDO $db;
    protected string $table;
    protected array $fillable = [];

    public function __construct()
    {
        $this->db = Database::connection();
    }

    public function all(string $orderBy = 'id DESC'): array
    {
        return $this->db->query("SELECT * FROM {$this->table} ORDER BY {$orderBy}")->fetchAll();
    }

    public function count(): int
    {
        return (int) $this->db->query("SELECT COUNT(*) FROM {$this->table}")->fetchColumn();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function create(array $data): bool
    {
        $payload = array_intersect_key($data, array_flip($this->fillable));
        $cols = array_keys($payload);
        $ph = array_map(fn (string $c): string => ':' . $c, $cols);
        $sql = sprintf('INSERT INTO %s (%s) VALUES (%s)', $this->table, implode(', ', $cols), implode(', ', $ph));
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($payload);
    }

    public function updateById(int $id, array $data): bool
    {
        $payload = array_intersect_key($data, array_flip($this->fillable));
        $set = array_map(fn (string $c): string => $c . ' = :' . $c, array_keys($payload));
        $payload['id'] = $id;
        $stmt = $this->db->prepare(sprintf('UPDATE %s SET %s WHERE id = :id', $this->table, implode(', ', $set)));
        return $stmt->execute($payload);
    }

    public function deleteById(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
