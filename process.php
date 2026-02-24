<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $customerName  = htmlspecialchars($_POST['customerName']);
    $customerPhone = htmlspecialchars($_POST['customerPhone']);
    $product       = htmlspecialchars($_POST['product']);
    $quantity      = (int) $_POST['quantity'];

    $prices = [
        "product1" => 1000,
        "product2" => 2000,
        "product3" => 3000
    ];

    $price = isset($prices[$product]) ? $prices[$product] : 0;
    $total = $price * $quantity;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Receipt</title>
</head>
<body>

<h2>Musanze Market Order Slip</h2>

<p><strong>Customer Name:</strong> <?php echo $customerName; ?></p>
<p><strong>Customer Phone:</strong> <?php echo $customerPhone; ?></p>
<p><strong>Product:</strong> <?php echo ucfirst($product); ?></p>
<p><strong>Quantity:</strong> <?php echo $quantity; ?></p>
<p><strong>Unit Price:</strong> <?php echo $price; ?> RWF</p>

<hr>

<p><strong>Total Amount:</strong> <?php echo $total; ?> RWF</p>

<br>

<a href="index.html">Back to Order Form</a>

</body>
</html>