<?php
require_once 'sparsh.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

if (isset($_POST['userid'])) {
    $userid = $_POST['userid'];

    echo <<<sparsh
    <html>
    <body>
    <form action="productadded.php" method="post">
    <label for="ProductName">ProductName</label>
        <input type="text" name="prodname" id="prodname" placeholder="Enter Product Name">
        <br>
    <label for="ProductPrice">ProductPrice</label>
        <input type="text" name="prodprice" id="prodprice" placeholder="Enter Product Price">
        <br>
    <label for="Category">Category</label>
        <select name="cat" id="cat">
            <option value="Catering">Catering</option>
            <option value="Florist">Florist</option>
            <option value="Decoration">Decoration</option>
            <option value="Lightning">Lightning</option>
        </select>
        <br>
    <input type="hidden" name="userid" id="userid" value="$userid">
    <button type="submit">Add To Cart</button>
    </form>
    </body>
    </html>
sparsh;
}
?>
