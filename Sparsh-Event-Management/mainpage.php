<?php

require_once 'sparsh.php';
$conn=new mysqli($hn,$un,$pw,$db);
if($conn->connect_error) die($conn->connect_error);
$userid=$_POST['userid'];
$password=$_POST['mypassword'];

$query1="SELECT * FROM Vendor where UserId='$userid' AND Password='$password'";
$result1=$conn->query($query1);
if(!$result1) die($conn->error);
$rows=$result1->num_rows;

if($rows==0)
{
	echo<<<main
    <html>
    <head>
        <title>Vendor Login</title>
    </head>
    <body>

    <h1>Event Management System</h1>
    <form method="post" action="mainpage.php">
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
    echo<<<main
    <html>
    <head>
    <style>
    .navbar {
        overflow: hidden;
        background-color: #ffffff;
        position: relative;
        
        top: 0;
        width: 100%;
      }
    </style>
    </head>
    <body>      
    <center>
    
    
    <h1>Welcome Vendor $userid</h1>
    <a href="signin1.html"><button class="button">Product Status</button></a>
    <a href="contact.html"><button class="button">Request Item</button></a>
    <a href="gallery.html"><button class="button">View Product</button></a>
    

    
    </center>
    <hr>
    <form method="post" action="youritem.php">
    <input type="text" name="userid" id="userid" readonly value=$userid hidden></input>
    <button type="submit">Your Item</button>
    </form>
    <form method="post" action="additem.php">
    <input type="text" name="userid" id="userid" readonly value=$userid hidden></input>
    <button type="submit">Add Item</button>
    </form>
    <form method="post" action="transaction.php">
    <button type="submit">Transaction</button>
    </form>
    <form method="post" action="vendorlogin.html">
    <button type="submit">Log out</button>
    </form>

    </body>
    </html>
    main;
}
$result1->close();
$conn->close();
?>
