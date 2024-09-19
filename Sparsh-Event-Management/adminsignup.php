

<?php

require_once 'sparsh.php';
$conn=new mysqli($hn,$un,$pw,$db);
if($conn->connect_error) die($conn->connect_error);
$username=$_POST['uname'];
$password=$_POST['password'];


$email=$_POST['email'];

$category=$_POST['cat'];
$query2="INSERT INTO Admin VALUES('$username','$password','$email','$category')";
$result2=$conn->query($query2);
if(!$result2) die($conn->error);


?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="login.css">
    <link rel="stylesheet" href="form.css">
    <title>Sign In Page</title>
  </head>
  <body>

    <h1>Welcome Admin </h1>
    <form method="post" action="maintainuser.html">
        <button type="submit">Maintain User</button>
</form>
<form method="post" action="maintainvendor.html">
        <button type="submit">Maintain Vendor</button>
</form>
  </body>
</html>