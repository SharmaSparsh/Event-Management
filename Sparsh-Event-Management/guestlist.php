<?php
require_once 'sparsh.php'; // Include your database connection file

// Connect to the database
$conn = new mysqli($hn, $un, $pw, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        // Add guest
        $name = $_POST['guest_name'];
        $email = $_POST['guest_email'];
        $phone = $_POST['guest_phone'];
        
        $sql = "INSERT INTO guests (guest_name, guest_email, guest_phone) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $email, $phone);
        
        if ($stmt->execute()) {
            echo "Guest added successfully.";
        } else {
            echo "Error adding guest: " . $conn->error;
        }
        
        $stmt->close();
    } elseif (isset($_POST['update'])) {
        // Update guest
        $id = $_POST['guest_id'];
        $name = $_POST['guest_name'];
        $email = $_POST['guest_email'];
        $phone = $_POST['guest_phone'];
        
        // Ensure ID exists
        $check_sql = "SELECT id FROM guests WHERE id = ?";
        $stmt = $conn->prepare($check_sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->close();
            
            $sql = "UPDATE guests SET guest_name = ?, guest_email = ?, guest_phone = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $name, $email, $phone, $id);
            
            if ($stmt->execute()) {
                echo "Guest updated successfully.";
            } else {
                echo "Error updating guest: " . $conn->error;
            }
            
            $stmt->close();
        } else {
            echo "Guest ID not found.";
        }
    } elseif (isset($_POST['delete'])) {
        // Delete guest
        $id = $_POST['guest_id'];
        
        // Ensure ID exists
        $check_sql = "SELECT id FROM guests WHERE id = ?";
        $stmt = $conn->prepare($check_sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->close();
            
            $sql = "DELETE FROM guests WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            
            if ($stmt->execute()) {
                echo "Guest deleted successfully.";
            } else {
                echo "Error deleting guest: " . $conn->error;
            }
            
            $stmt->close();
        } else {
            echo "Guest ID not found.";
        }
    }
}

// Fetch guest list items
$sql = "SELECT * FROM guests";
$result = $conn->query($sql);

// Check for errors
if (!$result) {
    die("Error fetching guest list: " . $conn->error);
}

// Fetch all guests
$guests = $result->fetch_all(MYSQLI_ASSOC);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest List</title>
</head>
<body>

<h2>Your Guest List</h2>

<!-- Display guest list items in a table -->
<?php if (count($guests) > 0): ?>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($guests as $index => $guest): ?>
                <tr>
                    <td><?php echo $index; ?></td>
                    <td><?php echo htmlspecialchars($guest['guest_name']); ?></td>
                    <td><?php echo htmlspecialchars($guest['guest_email']); ?></td>
                    <td><?php echo htmlspecialchars($guest['guest_phone']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No guests found.</p>
<?php endif; ?>

<h2>Add New Guest</h2>
<form action="guestlist.php" method="post">
    <label for="guest_name">Name:</label>
    <input type="text" id="guest_name" name="guest_name" required><br>
    <label for="guest_email">Email:</label>
    <input type="email" id="guest_email" name="guest_email" required><br>
    <label for="guest_phone">Phone:</label>
    <input type="text" id="guest_phone" name="guest_phone"><br>
    <button type="submit" name="add">Add Guest</button>
</form>

<h2>Update Guest</h2>
<form action="guestlist.php" method="post">
    <label for="guest_id">Guest ID:</label>
    <input type="number" id="guest_id" name="guest_id" required><br>
    <label for="guest_name">Name:</label>
    <input type="text" id="guest_name" name="guest_name" required><br>
    <label for="guest_email">Email:</label>
    <input type="email" id="guest_email" name="guest_email" required><br>
    <label for="guest_phone">Phone:</label>
    <input type="text" id="guest_phone" name="guest_phone"><br>
    <button type="submit" name="update">Update Guest</button>
</form>

<h2>Delete Guest</h2>
<form action="guestlist.php" method="post">
    <label for="guest_id">Guest ID:</label>
    <input type="number" id="guest_id" name="guest_id" required><br>
    <button type="submit" name="delete">Delete Guest</button>
</form>

</body>
</html>
