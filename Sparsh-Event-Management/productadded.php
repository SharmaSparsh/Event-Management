<?php
require_once 'sparsh.php';
$conn=new mysqli($hn,$un,$pw,$db);
if($conn->connect_error) die($conn->connect_error);
$prodname=$_POST['prodname'];
$prodprice=$_POST['prodprice'];
$vendorid=$_POST['userid'];
$cat=$_POST['cat'];
$query1="Insert into Products(ProductName,ProductPrice,VendorID,Category) values('$prodname','$prodprice','$vendorid','$cat')";
$result1=$conn->query($query1);
if(!$result1) die($conn->error);
$query2="Select*from Products";
$result2=$conn->query($query2);
$rows=$result2->num_rows;
if($rows==0)
{
    echo "no item inserted";
}
else
{
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
    

    <a href="vendorlogin.html"><button class="button">back to login</button></a>
    

    
    </center>
    <hr>
    </body>
    </html>
    main;
    echo "<table>";
    echo "<tr>";
    echo "<th>ProductId</th><th>ProductName</th><th>ProductPrice</th><th>VendorId</th><th>Categorry</th>";
    echo "</tr>";
    for($i=0;$i<$rows;$i++)
    {
        $result2->data_seek($i);
        $row=$result2->fetch_array(MYSQLI_ASSOC);
        
	    echo "<tr>";
     
	    echo "<td>".$row['ProductId']."</td><td>".$row['ProductName']."</td><td>".$row['ProductPrice']."</td><td>".$row['VendorID']."</td<td>".$row['Category']."</td>>";
	    echo "</tr>";
	
    }
    echo "</table>";
}
    
?>