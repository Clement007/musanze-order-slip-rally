<?php
// app/models/User.php

class User {
    private mysqli $db;

    public function __construct() {
        $this->db = getDB();
    }

    public function findByEmail(string $email): ?array {
        $stmt = $this->db->prepare(
            'SELECT id, full_name, email, password_hash, role FROM users WHERE email = ? LIMIT 1'
        );
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc() ?: null;
    }

    public function findById(int $id): ?array {
        $stmt = $this->db->prepare(
            'SELECT id, full_name, email, role FROM users WHERE id = ? LIMIT 1'
        );
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc() ?: null;
    }

    public function create(string $fullName, string $email, string $password, string $role = 'aggregator'): bool {
        $hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
        $stmt = $this->db->prepare(
            'INSERT INTO users (full_name, email, password_hash, role) VALUES (?, ?, ?, ?)'
        );
        $stmt->bind_param('ssss', $fullName, $email, $hash, $role);
        return $stmt->execute();
    }

    public function verifyPassword(string $password, string $hash): bool {
        return password_verify($password, $hash);
    }
}
