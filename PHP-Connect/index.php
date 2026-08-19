<!DOCTYPE html>
<html>
<body>
<?php
$servername = "localhost";
$username   = "root";   // MAMP default
$password   = "root";   // MAMP default
$dbname     = "store";
$port       = 8889;     // MAMP MySQL port

// Connect
$conn = mysqli_connect($servername, $username, $password, $dbname, $port);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query
$sql = "SELECT * FROM items";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>ID</th><th>Name</th><th>Price</th></tr>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>".$row['itemID']."</td><td>".$row['itemName']."</td><td>".$row['itemPrice']."</td></tr>";
    }
    echo "</table>";
} else {
    echo "No rows found!";
}

mysqli_close($conn);
?>
</body>
</html>
