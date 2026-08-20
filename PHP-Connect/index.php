<!DOCTYPE html>
<html>
<head>
    <title>Database Connection (MAMP)</title>
</head>
<body>
<?php
// Connect to MAMP MySQL
$connection = new mysqli('127.0.0.1', 'root', 'root', 'store', 8889);

// Check connection
if ($connection->connect_error) {
    die('Unable to connect: ' . $connection->connect_error);
}
echo "Connected successfully!<br>";

// create and execute query
$query = 'SELECT * FROM items';
$result = mysqli_query($connection, $query) or die ('Error in query: ' . mysqli_error($connection));

// check if records were returned
if (mysqli_num_rows($result) > 0) {
    // print HTML table
    echo '<table width=100% cellpadding=10 cellspacing=0 border=1>';
    echo '<tr><td><b>ID</b></td><td><b>Name</b></td><td><b>Price</b></td></tr>';
    while($row = mysqli_fetch_row($result)) {
        echo '<tr>';
        echo '<td>' . $row[0] . '</td>';
        echo '<td>' . $row[1] . '</td>';
        echo '<td>' . $row[2] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo 'No rows found!';
}

// free result set
mysqli_free_result($result);

// close connection
$connection->close();
?>
</body>
</html>
