<?php

require_once 'sparsh.php';
$conn=new mysqli($hn,$un,$pw,$db);
if($conn->connect_error) die($conn->connect_error);
$userid=$_POST['userid'];
$password=$_POST['mypassword'];

$query1="SELECT * FROM Admin where UserId='$userid' AND Password='$password'";
$result1=$conn->query($query1);
if(!$result1) die($conn->error);
$rows=$result1->num_rows;

if($rows==0)
{
	echo<<<main
    <html>
    <head>
        <title>Admin Login</title>
    </head>
    <body>

    <h1>Event Management System</h1>
    <form method="post" action="maintainencemenu.php">
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


}
else{
    echo "Maintainence page";
    echo<<<sparsh
    <html>
    <head>
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
    sparsh;
}
$result1->close();
$conn->close();
?>
