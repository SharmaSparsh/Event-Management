<?php
require_once 'sparsh.php'; // Database connection
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$userid = $_POST['userid'];
$password = $_POST['mypassword'];

// Check if the user exists
$query1 = "SELECT * FROM Users WHERE UserId='$userid' AND Password='$password'";
$result1 = $conn->query($query1);
if (!$result1) die($conn->error);

$rows = $result1->num_rows;

if ($rows == 0) {
    // If no user is found, prompt login again
    echo <<<main
    <html>
    <head>
        <title>User Login</title>
    </head>
    <body>

    <h1>Event Management System</h1>
    <form method="post" action="userlogin.php">
    <label for="userid">User Id</label>
     <input type="text" name="userid" id="userid" placeholder="User Id">
     <br>   
     <label for="mypassword">Password</label>
     <input type="password" name="mypassword" id="mypassword" placeholder="Password">
        <br>
        <button type="reset">Cancel</button>
        <button type="submit">Login</button>
    </form>

    </body>
    </html>
main;

} else {
    // If user is found, show options to navigate to different features
    echo "Welcome, $userid";
    echo <<<sparsh
    <html>
    <head>
        <title>User Dashboard</title>
    </head>
    <body>
    <h2>Choose an Service</h2>
    
    <form action="vendorlist.html" method="post">
        <button type="submit">Vendor</button>
    </form>
    
    <form action="cart.php" method="post">
        <button type="submit">Cart</button>
    </form>
    
    <form action="guestlist.php" method="post">
        <button type="submit">Guest List</button>
    </form>

    <form action="orderstatus.php" method="post">
        <button type="submit">Order Status</button>
    </form>
    
    </body>
    </html>
sparsh;
}
$result1->close();
$conn->close();
?>
