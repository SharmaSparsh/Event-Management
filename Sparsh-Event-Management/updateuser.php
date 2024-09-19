<?php

require_once 'sparsh.php';
$conn=new mysqli($hn,$un,$pw,$db);
if($conn->connect_error) die($conn->connect_error);
$userid=$_POST['uname'];
$email=$_POST['email'];
$password=$_POST['password'];

$query = "Update  Users set Password='$password', Email='$email' WHERE UserId='$userid'";
$result = $conn->query($query);

if (!$result) die($conn->error);

    echo "user upadted";

?>