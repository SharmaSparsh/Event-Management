<?php
// Initialize variables to empty values
$name = $email = $address = $status = '';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if POST data is set and sanitize it
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $address = isset($_POST['address']) ? htmlspecialchars($_POST['address']) : '';
    $status = isset($_POST['status']) ? htmlspecialchars($_POST['status']) : '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status</title>
    <link rel="stylesheet" href="stylesorder.css">
</head>
<body>
    <div class="navbar">
        <div class="navbar-left">
            <a href="index1.html">Home</a>
        </div>
        <div class="navbar-right">
            <a href="userlogin.html">Login</a>
            <a href="index1.html">Logout</a>
        </div>
    </div>
    <div class="content">
        <h1>User Order Status</h1>
        <form action="order_status.php" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>" required>
            </div>
            <div class="form-group">
                <label for="status">Order Status:</label>
                <select id="status" name="status" required>
                    <option value="">Select Status</option>
                    <option value="received" <?php echo $status === 'received' ? 'selected' : ''; ?>>Received</option>
                    <option value="ready for shipping" <?php echo $status === 'ready for shipping' ? 'selected' : ''; ?>>Ready for Shipping</option>
                    <option value="out for delivery" <?php echo $status === 'out for delivery' ? 'selected' : ''; ?>>Out for Delivery</option>
                </select>
            </div>
            <button type="submit">Submit</button>
        </form>
        
        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
        <div class="status-section">
            <h2>Order Status</h2>
            <ul>
                <li class="<?php echo strtolower($status) == 'received' ? 'active' : ''; ?>">Received</li>
                <li class="<?php echo strtolower($status) == 'ready for shipping' ? 'active' : ''; ?>">Ready for Shipping</li>
                <li class="<?php echo strtolower($status) == 'out for delivery' ? 'active' : ''; ?>">Out for Delivery</li>
            </ul>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>
