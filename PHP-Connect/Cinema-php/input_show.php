<?php

// Connect to database
$conn = mysqli_connect("127.0.0.1", "root", "", "cinema", 8889);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");

$message = "";
$showTable = false;

// Add movie
if (isset($_POST['add'])) {

    $movieTitle = trim($_POST['movieTitle'] ?? '');
    $movieYear = filter_input(INPUT_POST, 'movieYear', FILTER_VALIDATE_INT);

    $statement = mysqli_prepare($conn, "INSERT INTO movie (mtitle, myear) VALUES (?, ?)");
    mysqli_stmt_bind_param($statement, "si", $movieTitle, $movieYear);

    if ($movieTitle !== '' && $movieYear !== false && $movieYear >= 1901 && $movieYear <= 2155 && mysqli_stmt_execute($statement)) {
        $message = "Movie added successfully!";
    } else {
        $message = "Error: " . mysqli_stmt_error($statement);
    }
    mysqli_stmt_close($statement);
}

// Show table
if (isset($_POST['show'])) {
    $showTable = true;
}

// Clear output
if (isset($_POST['clear'])) {
    $showTable = false;
    $message = "";
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Cinema Movies</title>
</head>

<body>

<h2>Add Movie</h2>

<form method="post">

    <label>Movie Title:</label><br>
    <input type="text" name="movieTitle" required>

    <br><br>

    <label>Release Year:</label><br>
    <input type="number" name="movieYear" min="1901" max="2155" required>

    <br><br>

    <input type="submit" name="add" value="Add Movie">

    <input type="submit" name="show" value="Show">

    <input type="submit" name="clear" value="Clear">

</form>

<br>

<?php

// Display message
if ($message != "") {
    echo "<p>$message</p>";
}

// Display table
if ($showTable) {

    $sql = "SELECT mid, mtitle, myear FROM movie ORDER BY mid";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

?>

<h2>Movies in Cinema</h2>

<table border="1" cellpadding="10">

    <tr>
        <th>Movie ID</th>
        <th>Movie Title</th>
        <th>Release Year</th>
    </tr>

<?php

        while ($row = mysqli_fetch_assoc($result)) {

?>

    <tr>
        <td><?php echo htmlspecialchars($row['mid'], ENT_QUOTES, 'UTF-8'); ?></td>
        <td><?php echo htmlspecialchars($row['mtitle'], ENT_QUOTES, 'UTF-8'); ?></td>
        <td><?php echo htmlspecialchars($row['myear'], ENT_QUOTES, 'UTF-8'); ?></td>
    </tr>

<?php

        }

?>

</table>

<?php

    } else {

        echo "<p>No movies found.</p>";

    }
}

mysqli_close($conn);

?>

</body>
</html>