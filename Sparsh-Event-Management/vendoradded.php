

<?php

require_once 'sparsh.php';
$conn=new mysqli($hn,$un,$pw,$db);
if($conn->connect_error) die($conn->connect_error);
$username=$_POST['userid'];
$password=$_POST['password'];




$query2="INSERT INTO Vendor(UserId,Password) VALUES('$username','$password')";
$result2=$conn->query($query2);
if(!$result2) die($conn->error);


?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="login.css">
    <link rel="stylesheet" href="form.css">
    <a href="vendorlogin.html">
    <title>Vendor Added</title>
  </head>
  <body>

    <h1> Successfully Vendor User</h1>
  </body>
</html>