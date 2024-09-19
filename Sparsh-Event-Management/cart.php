<?php
require_once 'sparsh.php'; // Include your database connection file

// Connect to the database
$conn = new mysqli($hn, $un, $pw, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch cart items from the database
$sql = "SELECT CartId, ProductName, ProductPrice, Qty, TotalPrice FROM cart";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$cart_items = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Calculate total amount
$total = 0;
foreach ($cart_items as $item) {
    $total += $item['TotalPrice'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>
</head>
<body>

    <center><h1>Your Cart</h1></center>

    <table border="1" width="80%" align="center">
        <tr>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total Price</th>
        </tr>

        <?php foreach ($cart_items as $item): ?>
        <tr>
            <td><?php echo $item['ProductName']; ?></td>
            <td>Rs. <?php echo $item['ProductPrice']; ?>/-</td>
            <td><?php echo $item['Qty']; ?></td>
            <td>Rs. <?php echo $item['TotalPrice']; ?>/-</td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2 align="center">Total Amount: Rs. <?php echo $total; ?>/-</h2>

    <!-- Payment options -->
    <div align="center">
        <form method="post" action="payment.php">
            <!-- Cash on Delivery Option -->
            <input type="submit" name="cod" value="Proceed with COD">

            <!-- Paytm Payment Option -->
            <input type="submit" name="paytm" value="Proceed with Paytm">
        </form>
    </div>

</body>
</html>
