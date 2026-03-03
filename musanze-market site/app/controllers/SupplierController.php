<?php
// app/controllers/SupplierController.php

class SupplierController {

    private Supplier $model;

    public function __construct() {
        $this->model = new Supplier();
    }

    public function index(): void {
        $suppliers = $this->model->getAll();
        require __DIR__ . '/../views/suppliers/list.php';
    }

    public function create(): void {
        $errors = [];
        $data   = ['name' => '', 'phone' => '', 'location' => ''];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data['name']     = trim($_POST['name'] ?? '');
            $data['phone']    = trim($_POST['phone'] ?? '');
            $data['location'] = trim($_POST['location'] ?? '');

            if (empty($data['name']))     $errors[] = 'Supplier name is required.';
            if (empty($data['phone']))    $errors[] = 'Phone number is required.';
            if (empty($data['location'])) $errors[] = 'Location is required.';
            if (!preg_match('/^\+?[\d\s\-]{7,20}$/', $data['phone'])) {
                $errors[] = 'Phone number format is invalid.';
            }

            if (empty($errors)) {
                if ($this->model->create($data['name'], $data['phone'], $data['location'])) {
                    $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Supplier registered successfully.'];
                    header('Location: index.php?route=suppliers');
                    exit;
                }
                $errors[] = 'Failed to register supplier. Please try again.';
            }
        }

        require __DIR__ . '/../views/suppliers/create.php';
    }

    public function edit(int $id): void {
        $supplier = $this->model->findById($id);
        if (!$supplier) {
            $_SESSION['flash'] = ['type' => 'danger', 'msg' => 'Supplier not found.'];
            header('Location: index.php?route=suppliers');
            exit;
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name     = trim($_POST['name'] ?? '');
            $phone    = trim($_POST['phone'] ?? '');
            $location = trim($_POST['location'] ?? '');

            if (empty($name))     $errors[] = 'Name is required.';
            if (empty($phone))    $errors[] = 'Phone is required.';
            if (empty($location)) $errors[] = 'Location is required.';

            if (empty($errors)) {
                $this->model->update($id, $name, $phone, $location);
                $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Supplier updated.'];
                header('Location: index.php?route=suppliers');
                exit;
            }
            $supplier = array_merge($supplier, compact('name', 'phone', 'location'));
        }

        require __DIR__ . '/../views/suppliers/edit.php';
    }

    public function delete(int $id): void {
        if ($this->model->delete($id)) {
            $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Supplier deleted.'];
        } else {
            $_SESSION['flash'] = ['type' => 'danger', 'msg' => 'Could not delete supplier. They may have existing orders.'];
        }
        header('Location: index.php?route=suppliers');
        exit;
    }
}
