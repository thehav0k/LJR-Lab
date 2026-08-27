<?php

// Connect to database
$conn = mysqli_connect("127.0.0.1", "root", "", "cinema", 8889);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");

// Select all movies
$sql = "SELECT mid, mtitle, myear FROM movie ORDER BY mid";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Movies List</title>
</head>

<body>

<h2>Movies in Cinema</h2>

<table border="1" cellpadding="10">

    <tr>
        <th>Movie ID</th>
        <th>Movie Title</th>
        <th>Release Year</th>
    </tr>

<?php

if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {

?>

    <tr>
        <td><?php echo htmlspecialchars($row['mid'], ENT_QUOTES, 'UTF-8'); ?></td>
        <td><?php echo htmlspecialchars($row['mtitle'], ENT_QUOTES, 'UTF-8'); ?></td>
        <td><?php echo htmlspecialchars($row['myear'], ENT_QUOTES, 'UTF-8'); ?></td>
    </tr>

<?php

    }

} else {

    echo "<tr><td colspan='3'>No movies found</td></tr>";

}

?>

</table>

</body>
</html>

<?php

mysqli_close($conn);

?>