<?php

$conn = mysqli_connect("127.0.0.1", "root", "", "cinema", 8889);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");

if (isset($_POST['submit'])) {

    $movieTitle = trim($_POST['movieTitle'] ?? '');
    $movieYear = filter_input(INPUT_POST, 'movieYear', FILTER_VALIDATE_INT);

    $statement = mysqli_prepare($conn, "INSERT INTO movie (mtitle, myear) VALUES (?, ?)");
    mysqli_stmt_bind_param($statement, "si", $movieTitle, $movieYear);

    if ($movieTitle !== '' && $movieYear !== false && $movieYear >= 1901 && $movieYear <= 2155 && mysqli_stmt_execute($statement)) {
        echo "Movie added successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_stmt_close($statement);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Movie</title>
</head>

<body>

<h2>Add New Movie</h2>

<form method="post">

    Movie Title:
    <input type="text" name="movieTitle" required>

    <br><br>

    Release Year:
    <input type="number" name="movieYear" min="1901" max="2155" required>

    <br><br>

    <input type="submit" name="submit" value="Add Movie">

</form>

</body>
</html>