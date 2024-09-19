<?php

require_once 'sparsh.php';
$conn=new mysqli($hn,$un,$pw,$db);
if($conn->connect_error) die($conn->connect_error);
$userid=$_POST['uname'];

$password=$_POST['password'];
$email=$_POST['email'];
$membership=$_POST['membership'];
$query = "Update  Users set Password='$password',Email='$email', Membership='$membership' WHERE UserId='$userid'";
$result = $conn->query($query);

if (!$result) die($conn->error);

    echo "user membership upadted";

?>