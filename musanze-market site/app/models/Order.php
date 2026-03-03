<?php
// app/models/Order.php

class Order {
    private mysqli $db;

    public function __construct() {
        $this->db = getDB();
    }

    public function generateRef(): string {
        $year  = date('Y');
        $count = (int)$this->db->query(
            "SELECT COUNT(*) FROM orders WHERE YEAR(created_at) = $year"
        )->fetch_row()[0];
        return sprintf('ORD-%s-%03d', $year, $count + 1);
    }

    public function getAll(int $limit = 0): array {
        $sql = '
            SELECT o.*, s.name AS supplier_name, s.phone AS supplier_phone,
                   u.full_name AS created_by_name
            FROM orders o
            JOIN suppliers s ON s.id = o.supplier_id
            JOIN users u ON u.id = o.created_by
            ORDER BY o.created_at DESC
        ';
        if ($limit > 0) {
            $sql .= " LIMIT $limit";
        }
        return $this->db->query($sql)->fetch_all(MYSQLI_ASSOC);
    }

    public function findById(int $id): ?array {
        $stmt = $this->db->prepare('
            SELECT o.*, s.name AS supplier_name, s.phone AS supplier_phone,
                   s.location AS supplier_location, u.full_name AS created_by_name
            FROM orders o
            JOIN suppliers s ON s.id = o.supplier_id
            JOIN users u ON u.id = o.created_by
            WHERE o.id = ?
            LIMIT 1
        ');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc() ?: null;
    }

    public function create(array $data, int $userId): bool {
        $ref          = $this->generateRef();
        // Always calculate total from qty * price
        $total_amount = (float)$data['quantity'] * (float)$data['unit_price'];

        $stmt = $this->db->prepare('
            INSERT INTO orders
                (order_ref, supplier_id, product_name, quantity, unit,
                 unit_price, total_amount, pickup_location, pickup_date,
                 status, notes, created_by)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ');
        $stmt->bind_param(
            'sisdsddssssi',
            $ref,
            $data['supplier_id'],
            $data['product_name'],
            $data['quantity'],
            $data['unit'],
            $data['unit_price'],
            $total_amount,
            $data['pickup_location'],
            $data['pickup_date'],
            $data['status'],
            $data['notes'],
            $userId
        );
        return $stmt->execute();
    }

    public function update(int $id, array $data): bool {
        // Always recalculate total from qty * price on every update
        $total_amount = (float)$data['quantity'] * (float)$data['unit_price'];

        $stmt = $this->db->prepare('
            UPDATE orders
            SET supplier_id      = ?,
                product_name     = ?,
                quantity         = ?,
                unit             = ?,
                unit_price       = ?,
                total_amount     = ?,
                pickup_location  = ?,
                pickup_date      = ?,
                status           = ?,
                notes            = ?
            WHERE id = ?
        ');
        $stmt->bind_param(
            'isdsddsssi',
            $data['supplier_id'],
            $data['product_name'],
            $data['quantity'],
            $data['unit'],
            $data['unit_price'],
            $total_amount,
            $data['pickup_location'],
            $data['pickup_date'],
            $data['status'],
            $data['notes'],
            $id
        );
        return $stmt->execute();
    }

    public function delete(int $id): bool {
        $stmt = $this->db->prepare('DELETE FROM orders WHERE id = ?');
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    // ── Dashboard stats ─────────────────────────────────────

    public function countToday(): int {
        return (int)$this->db->query(
            "SELECT COUNT(*) FROM orders WHERE DATE(created_at) = CURDATE()"
        )->fetch_row()[0];
    }

    public function totalValueToday(): float {
        $val = $this->db->query(
            "SELECT SUM(total_amount) FROM orders WHERE DATE(created_at) = CURDATE()"
        )->fetch_row()[0];
        return (float)($val ?? 0);
    }

    public function totalValueAll(): float {
        $val = $this->db->query("SELECT SUM(total_amount) FROM orders")->fetch_row()[0];
        return (float)($val ?? 0);
    }

    public function countByStatus(string $status): int {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM orders WHERE status = ?");
        $stmt->bind_param('s', $status);
        $stmt->execute();
        return (int)$stmt->get_result()->fetch_row()[0];
    }

    public function countAll(): int {
        return (int)$this->db->query("SELECT COUNT(*) FROM orders")->fetch_row()[0];
    }
}