<?php
require_once 'sparsh.php';
$conn=new mysqli($hn,$un,$pw,$db);
if($conn->connect_error) die($conn->connect_error);
$userid=$_POST['userid'];
$query2="delete from Products where VendorID='$userid'";
$result2=$conn->query($query2);
$rows=$result2->num_rows;
echo "Product Deleted";
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
?>