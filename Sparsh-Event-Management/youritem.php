<?php
require_once 'sparsh.php'; // Database connection

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$userid = $_POST['userid'];

// Handle product deletion
if (isset($_POST['delete_product'])) {
    $productid = $_POST['productid'];
    $delete_query = "DELETE FROM Products WHERE ProductId='$productid' AND VendorID='$userid'";
    if ($conn->query($delete_query)) {
        echo "Product deleted successfully!";
    } else {
        echo "Error deleting product: " . $conn->error;
    }
}

// Handle new product insertion
if (isset($_POST['insert_product'])) {
    $productname = $_POST['productname'];
    $productprice = $_POST['productprice'];
    $category = $_POST['category'];

    $insert_query = "INSERT INTO Products (ProductName, ProductPrice, VendorID, Category) VALUES ('$productname', '$productprice', '$userid', '$category')";
    if ($conn->query($insert_query)) {
        echo "Product added successfully!";
    } else {
        echo "Error adding product: " . $conn->error;
    }
}

// Query to fetch products of the vendor
$query2 = "SELECT * FROM Products WHERE VendorID='$userid'";
$result2 = $conn->query($query2);
$rows = $result2->num_rows;

echo <<<HTML
<html>
<head>
    <title>Vendor Products</title>
    <style>
        .navbar {
            overflow: hidden;
            background-color: #ffffff;
            position: relative;
            top: 0;
            width: 100%;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        button {
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .form-container {
            margin: 20px auto;
            width: 80%;
            text-align: center;
        }
    </style>
</head>
<body>
    <center>
        <a href="vendorlogin.html"><button>Back to Login</button></a>
        <hr>
    </center>
    <h2 style="text-align:center;">Products List for Vendor ID: $userid</h2>
HTML;

// Display the products table
if ($rows == 0) {
    echo "No products found for Vendor ID: $userid";
} else {
    echo "<table>";
    echo "<tr>";
    echo "<th>ProductId</th><th>ProductName</th><th>ProductPrice</th><th>VendorId</th><th>Action</th>";
    echo "</tr>";

    for ($i = 0; $i < $rows; $i++) {
        $result2->data_seek($i);
        $row = $result2->fetch_array(MYSQLI_ASSOC);

        echo "<tr>";
        echo "<td>" . $row['ProductId'] . "</td>";
        echo "<td>" . $row['ProductName'] . "</td>";
        echo "<td>" . $row['ProductPrice'] . "</td>";
        echo "<td>" . $row['VendorID'] . "</td>";

        // Delete button for each product
        echo "<td>
                <form action='' method='post' style='display:inline;'>
                    <input type='hidden' name='userid' value='" . $userid . "'>
                    <input type='hidden' name='productid' value='" . $row['ProductId'] . "'>
                    <button type='submit' name='delete_product'>Delete</button>
                </form>
              </td>";
        echo "</tr>";
    }
    echo "</table>";
}

// Form to add a new product
echo <<<HTML
    <div class="form-container">
        <h3>Add New Product</h3>
        <form action="" method="post">
            <input type="hidden" name="userid" value="$userid">
            <input type="text" name="productname" placeholder="Product Name" required>
            <input type="number" name="productprice" placeholder="Product Price" required>
            <input type="text" name="category" placeholder="Category" required>
            <button type="submit" name="insert_product">Insert</button>
        </form>
    </div>
</body>
</html>
HTML;

$conn->close();
?>