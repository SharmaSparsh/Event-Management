<?php
require_once 'sparsh.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

// Retrieve and validate POST data
$cat = isset($_POST['cat']) ? $_POST['cat'] : '';
$vendorid = isset($_POST['vendorid']) ? $_POST['vendorid'] : '';
$prodname = isset($_POST['prodname']) ? $_POST['prodname'] : '';
$prodprice = isset($_POST['prodprice']) ? $_POST['prodprice'] : 0;
$prodid = isset($_POST['productid']) ? $_POST['productid'] : '';
$qty = isset($_POST['qty']) ? $_POST['qty'] : 0;
$total = $prodprice * $qty;

// Validate ProductId
$queryCheckProduct = "SELECT ProductID FROM Products WHERE ProductID = ?";
$stmtCheckProduct = $conn->prepare($queryCheckProduct);
$stmtCheckProduct->bind_param('i', $prodid); // Assuming ProductID is an integer
$stmtCheckProduct->execute();
$stmtCheckProduct->store_result();

if ($stmtCheckProduct->num_rows === 0) {
    die("Product ID $prodid does not exist in the Products table.");
}

// Insert into Cart table
$query2 = "INSERT INTO Cart (VendorId, Category, ProductId, ProductName, ProductPrice, Qty, TotalPrice) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt2 = $conn->prepare($query2);
$stmt2->bind_param('sssddid', $vendorid, $cat, $prodid, $prodname, $prodprice, $qty, $total);
if (!$stmt2->execute()) die($stmt2->error);

// Display Products for the selected vendor and category
$query1 = "SELECT * FROM Products WHERE VendorID = ? AND Category = ?";
$stmt1 = $conn->prepare($query1);
$stmt1->bind_param('ss', $vendorid, $cat);
$stmt1->execute();
$result3 = $stmt1->get_result();

echo "Vendor :: $vendorid";
echo "<table border='1'>";
echo "<br>";
echo "Product added to cart";
if (!$result3) die($conn->error);
$rows = $result3->num_rows;
for ($i = 0; $i < $rows; $i++) {
    $row = $result3->fetch_assoc();
    $pname = $row['ProductName'];
    $pprice = $row['ProductPrice'];
    $productid = $row['ProductID'];
    echo "<tr>";
    echo "<td>";
    echo "<form method='post' action='showusercart.php'>";
    echo "<input type='text' readonly name='productid' id='productid' value='$productid' hidden>";
    echo "<input type='text' readonly name='prodname' id='prodname' value='$pname'>";
    echo "<input type='text' readonly name='prodprice' id='prodprice' value='$pprice'>";
    echo "<input type='text' readonly name='cat' id='cat' value='$cat' hidden>";
    echo "<input type='text' readonly name='vendorid' id='vendorid' value='$vendorid' hidden>";
    echo "Qty :: <input type='text' name='qty' id='qty'>";
    echo "<input type='submit' value='Add to Cart'>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}
echo "</table>";

// Display Cart contents
$query4 = "SELECT * FROM Cart";
$result4 = $conn->query($query4);
if (!$result4) die($conn->error);

echo "<br><br>";
echo "<table border='1'>";
echo "<br>";
echo "<tr><th>VendorId</th><th>CartId</th><th>Category</th><th>ProductName</th><th>ProductPrice</th><th>ProductId</th><th>Qty</th><th>Total</th></tr>";
$rows1 = $result4->num_rows;
for ($i = 0; $i < $rows1; $i++) {
    $row = $result4->fetch_assoc();
    echo "<tr>";
    echo "<td>{$row['VendorId']}</td>";
    echo "<td>{$row['CartId']}</td>";
    echo "<td>{$row['Category']}</td>";
    echo "<td>{$row['ProductName']}</td>";
    echo "<td>{$row['ProductPrice']}</td>";
    echo "<td>{$row['ProductId']}</td>";
    echo "<td>{$row['Qty']}</td>";
    echo "<td>{$row['TotalPrice']}</td>";
    echo "</tr>";
}
echo "</table>";

$stmt1->close();
$stmt2->close();
$stmtCheckProduct->close();
$conn->close();
?>
