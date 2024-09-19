<?php

require_once 'sparsh.php';
$conn=new mysqli($hn,$un,$pw,$db);
if($conn->connect_error) die($conn->connect_error);
$userid=$_POST['uname'];

$password=$_POST['password'];

$query = "Update  Vendor set Password='$password' WHERE UserId='$userid'";
$result = $conn->query($query);

if (!$result) die($conn->error);

    echo "Vendor upadted";

?>