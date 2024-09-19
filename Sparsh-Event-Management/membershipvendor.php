<?php

require_once 'sparsh.php';
$conn=new mysqli($hn,$un,$pw,$db);
if($conn->connect_error) die($conn->connect_error);
$userid=$_POST['uname'];

$password=$_POST['password'];
$membership=$_POST['membership'];
$query = "Update  Vendor set Password='$password', Membership='$membership' WHERE UserId='$userid'";
$result = $conn->query($query);

if (!$result) die($conn->error);

    echo "vendor membership upadted";

?>