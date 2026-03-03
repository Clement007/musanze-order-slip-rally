-- Seed data for Musanze Market

INSERT INTO `users` (`full_name`, `email`, `password_hash`, `role`) VALUES
('Admin User', 'admin@musanze.rw', '$2y$12$LpBVJFvCJr.DkNZ5JkqKheBTIVN6WN1K7YXfpNHvmE5LRMi7KEOFC', 'admin'),
('Jean Baptiste', 'jean@musanze.rw', '$2y$12$LpBVJFvCJr.DkNZ5JkqKheBTIVN6WN1K7YXfpNHvmE5LRMi7KEOFC', 'aggregator');

INSERT INTO `suppliers` (`name`, `phone`, `location`) VALUES
('Uwimana Celestin', '+250788123456', 'Kinigi Sector'),
('Mukamana Marie', '+250722345678', 'Cyuve Sector'),
('Habimana Jean Pierre', '+250783456789', 'Shingiro Sector'),
('Nyirahabimana Jeanne', '+250788567890', 'Gataraga Sector'),
('Bizimana Emmanuel', '+250722678901', 'Muhoza Sector');

INSERT INTO `orders` (`order_ref`, `supplier_id`, `product_name`, `quantity`, `unit`, `unit_price`, `total_amount`, `pickup_location`, `pickup_date`, `status`, `created_by`) VALUES
('ORD-2025-001', 1, 'Irish Potato', 500.00, 'kg', 150.00, 75000.00, 'Musanze Central Market', '2025-02-27', 'confirmed', 1),
('ORD-2025-002', 2, 'Sweet Potato', 300.00, 'kg', 120.00, 36000.00, 'Kinigi Collection Point', '2025-02-27', 'pending', 2),
('ORD-2025-003', 3, 'Irish Potato', 1000.00, 'kg', 145.00, 145000.00, 'Cyuve Depot', '2025-02-28', 'pending', 2);
