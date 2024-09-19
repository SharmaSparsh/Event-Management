

<?php

require_once 'sparsh.php';
$conn=new mysqli($hn,$un,$pw,$db);
if($conn->connect_error) die($conn->connect_error);
$userid=$_POST['userid'];

$query = "SELECT * FROM Users WHERE UserId='$userid'";
	$result = $conn->query($query);

	if (!$result) die($conn->error);
	$rows=$result->num_rows;
if($rows==0)
{
    echo "no User exists";
}
else
{
    
        
        $row=$result->fetch_array(MYSQLI_ASSOC);
        $userid=$row['UserId'];
        $password=$row['Password'];
        $email=$row['Email'];
        $membership=$row['Membership'];
       
        echo<<<sparsh
        <html>
        <body>
        <form method="post" action="membershipuser1.php">
                <label for="uname">Name:</label>
                <input type="text"  name="uname" id="uname" value=$userid readonly>
            
                
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" value=$password>
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$">
                <label for="membership">Membership</label>
                <select name="membership" id="membership">
                    <option value="6 months">6 months</option>
                    <option value="1 year">1 year</option>
                    <option value="2 year">2 year</option>
                </select>
                
                <button type="submit">update</button>
        </form>
        </body>
        </html>
        sparsh;
}
?>