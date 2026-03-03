<?php
// app/models/Supplier.php

class Supplier {
    private mysqli $db;

    public function __construct() {
        $this->db = getDB();
    }

    public function getAll(): array {
        $result = $this->db->query('SELECT * FROM suppliers ORDER BY name ASC');
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function findById(int $id): ?array {
        $stmt = $this->db->prepare('SELECT * FROM suppliers WHERE id = ? LIMIT 1');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc() ?: null;
    }

    public function create(string $name, string $phone, string $location): bool {
        $stmt = $this->db->prepare(
            'INSERT INTO suppliers (name, phone, location) VALUES (?, ?, ?)'
        );
        $stmt->bind_param('sss', $name, $phone, $location);
        return $stmt->execute();
    }

    public function update(int $id, string $name, string $phone, string $location): bool {
        $stmt = $this->db->prepare(
            'UPDATE suppliers SET name = ?, phone = ?, location = ? WHERE id = ?'
        );
        $stmt->bind_param('sssi', $name, $phone, $location, $id);
        return $stmt->execute();
    }

    public function delete(int $id): bool {
        $stmt = $this->db->prepare('DELETE FROM suppliers WHERE id = ?');
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    public function count(): int {
        return (int)$this->db->query('SELECT COUNT(*) FROM suppliers')->fetch_row()[0];
    }
}
