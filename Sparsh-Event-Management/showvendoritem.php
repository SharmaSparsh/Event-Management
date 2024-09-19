<?php
require_once 'sparsh.php';
$conn=new mysqli($hn,$un,$pw,$db);
if($conn->connect_error) die($conn->connect_error);
$cat=$_POST['cat'];
$vendorid=$_POST['vendorid'];
$query1="select*from Products where VendorID='$vendorid' and Category='$cat'";

$result2=$conn->query($query1);
if(!$result2) die($conn->error);
$rows=$result2->num_rows;
if($rows==0)
{
    echo "none";
}
else{
    echo " vendor :: $vendorid";
    echo "<table>";
   
    
    for($i=0;$i<$rows;$i++)
    {
        $result2->data_seek($i);
        $row=$result2->fetch_array(MYSQLI_ASSOC);
        $pname=$row['ProductName'];
        $pprice=$row['ProductPrice'];
        $productid=$row['ProductId'];
        echo "<tr>";
        
	    
	    echo "<td><form method=post action=showusercart.php>";
        echo "<input type=text readonly name=productid id=productid value=$productid hidden>";
        echo "<input type=text readonly name=prodname id=prodname value=$pname>";
        echo "<input type=text readonly name=prodprice id=prodprice value=$pprice>";
        echo "<input type=text readonly name=cat id=cat value=$cat hidden>";
        echo "<input type=text readonly name=vendorid id=vendorid value=$vendorid hidden>";
        echo "Qty :: <input type=text name=qty id=qty>";
        echo "<input type=submit value=Addd_to_cart></input>";
        echo "</form></td>";
        echo "</tr>";
    }
   
    echo "</table>";
}



?>