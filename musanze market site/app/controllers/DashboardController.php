<?php
// app/controllers/DashboardController.php

class DashboardController {

    private Order    $orderModel;
    private Supplier $supplierModel;

    public function __construct() {
        $this->orderModel    = new Order();
        $this->supplierModel = new Supplier();
    }

    public function index(): void {
        $stats = [
            'orders_today'    => $this->orderModel->countToday(),
            'value_today'     => $this->orderModel->totalValueToday(),
            'value_total'     => $this->orderModel->totalValueAll(),
            'orders_total'    => $this->orderModel->countAll(),
            'pending'         => $this->orderModel->countByStatus('pending'),
            'confirmed'       => $this->orderModel->countByStatus('confirmed'),
            'suppliers_total' => $this->supplierModel->count(),
        ];
        $recentOrders = $this->orderModel->getAll(10);

        require __DIR__ . '/../views/dashboard/index.php';
    }
}
