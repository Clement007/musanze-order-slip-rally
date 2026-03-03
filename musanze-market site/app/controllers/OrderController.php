<?php
// app/controllers/OrderController.php

class OrderController {

    private Order    $model;
    private Supplier $supplierModel;

    public function __construct() {
        $this->model         = new Order();
        $this->supplierModel = new Supplier();
    }

    public function index(): void {
        $orders = $this->model->getAll();
        require __DIR__ . '/../views/orders/list.php';
    }

    public function create(): void {
        $errors    = [];
        $suppliers = $this->supplierModel->getAll();
        $data      = [
            'supplier_id'     => '',
            'product_name'    => '',
            'quantity'        => '',
            'unit'            => 'kg',
            'unit_price'      => '',
            'pickup_location' => '',
            'pickup_date'     => date('Y-m-d'),
            'status'          => 'pending',
            'notes'           => '',
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->sanitizeOrderInput($_POST);
            $errors = $this->validateOrderData($data);

            if (empty($errors)) {
                if ($this->model->create($data, (int)$_SESSION['user_id'])) {
                    $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Order created successfully!'];
                    header('Location: index.php?route=orders');
                    exit;
                }
                $errors[] = 'Failed to save order. Please try again.';
            }
        }

        require __DIR__ . '/../views/orders/create.php';
    }

    public function view(int $id): void {
        $order = $this->model->findById($id);
        if (!$order) {
            $_SESSION['flash'] = ['type' => 'danger', 'msg' => 'Order not found.'];
            header('Location: index.php?route=orders');
            exit;
        }
        require __DIR__ . '/../views/orders/view.php';
    }

    public function edit(int $id): void {
        $order = $this->model->findById($id);
        if (!$order) {
            $_SESSION['flash'] = ['type' => 'danger', 'msg' => 'Order not found.'];
            header('Location: index.php?route=orders');
            exit;
        }

        $errors    = [];
        $suppliers = $this->supplierModel->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data   = $this->sanitizeOrderInput($_POST);
            $errors = $this->validateOrderData($data);

            if (empty($errors)) {
                $this->model->update($id, $data);
                $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Order updated successfully.'];
                header('Location: index.php?route=orders/view&id=' . $id);
                exit;
            }
            $order = array_merge($order, $data);
        }

        require __DIR__ . '/../views/orders/edit.php';
    }

    public function delete(int $id): void {
        $this->model->delete($id);
        $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Order deleted.'];
        header('Location: index.php?route=orders');
        exit;
    }

    public function receipt(int $id): void {
        $order = $this->model->findById($id);
        if (!$order) {
            header('Location: index.php?route=orders');
            exit;
        }
        require __DIR__ . '/../views/orders/receipt.php';
    }

    // ── Private helpers ──────────────────────────────────────────────────────

    private function sanitizeOrderInput(array $post): array {
        return [
            'supplier_id'     => (int)($post['supplier_id'] ?? 0),
            'product_name'    => trim($post['product_name'] ?? ''),
            'quantity'        => (float)($post['quantity'] ?? 0),
            'unit'            => trim($post['unit'] ?? 'kg'),
            'unit_price'      => (float)($post['unit_price'] ?? 0),
            'pickup_location' => trim($post['pickup_location'] ?? ''),
            'pickup_date'     => trim($post['pickup_date'] ?? ''),
            'status'          => trim($post['status'] ?? 'pending'),
            'notes'           => trim($post['notes'] ?? ''),
        ];
    }

    private function validateOrderData(array $data): array {
        $errors = [];
        $validUnits    = ['kg', 'tonne', 'bag', 'crate', 'piece'];
        $validStatuses = ['pending', 'confirmed', 'collected', 'cancelled'];

        if ($data['supplier_id'] <= 0)       $errors[] = 'Please select a supplier.';
        if (empty($data['product_name']))     $errors[] = 'Product name is required.';
        if ($data['quantity'] <= 0)           $errors[] = 'Quantity must be greater than zero.';
        if ($data['unit_price'] <= 0)         $errors[] = 'Unit price must be greater than zero.';
        if (empty($data['pickup_location']))  $errors[] = 'Pickup location is required.';
        if (empty($data['pickup_date']))      $errors[] = 'Pickup date is required.';
        if (!in_array($data['unit'], $validUnits))       $errors[] = 'Invalid unit selected.';
        if (!in_array($data['status'], $validStatuses))  $errors[] = 'Invalid status.';

        return $errors;
    }
}
