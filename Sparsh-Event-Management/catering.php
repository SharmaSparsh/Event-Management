<?php
require_once 'sparsh.php';
$conn=new mysqli($hn,$un,$pw,$db);
if($conn->connect_error) die($conn->connect_error);
$cat=$_POST['cat'];

$query2="select*from Products where Category='$cat' group by VendorID";
$result2=$conn->query($query2);
if(!$result2) die($conn->error);
$rows=$result2->num_rows;

if($rows==0)
{
    echo "  none";

}
else{
    echo " vendor :: $cat";
    echo "<table>";
   
   
    for($i=0;$i<$rows;$i++)
    {
        $result2->data_seek($i);
        $row=$result2->fetch_array(MYSQLI_ASSOC);
        $vid=$row['VendorID'];
        echo "<tr>";
        
	    echo "<td>".$row['VendorID']."</td>";
	    echo "<td><form method=post action=showvendoritem.php>";
        echo "<input type=text readonly name=cat id=cat value=$cat hidden></input>";
        echo "<input type=text readonly name=vendorid id=vendorid value=$vid hidden></input>";
        echo "<input type=submit value=Shop></input>";
        echo "</form></td>";
        echo "</tr>";
    }
   
    echo "</table>";
}
?>