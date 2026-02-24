<?php
$name = $_POST['name'] ?? '';
$qty = $_POST['qty'] ?? 0;
$price = $_POST['price'] ?? 0;
$total = $qty * $price;
?>

<h2>Order Receipt</h2>

<p>Name: <?php echo $name; ?></p>
<p>Total: <?php echo $total; ?></p>

<a href="index.html">Back</a>

<?php
// RELAY:
// Student 1 → Sanitize output
// Student 2 → Format receipt layout
// Student 3 → Handle empty values
// Student 4 → Add current date
// Student 5 → Improve total currency format
?>