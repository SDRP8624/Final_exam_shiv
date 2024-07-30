<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Exam</title>
    <link rel="icon" href="img\favicon.png" type="image/x-icon">
</head>
<body>
<?php include 'header.php'; ?>

<form method="post" action="index.php">
    <input type="text" name="message" required>
    <button type="submit" name="submit">Submit</button>
</form>

<a href="showAll.php">Show all records</a>

<?php
if (isset($_POST['submit'])) {
    $message = $_POST['message'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'final');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepared statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO string_info (message) VALUES (?)");
    $stmt->bind_param("s", $message);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}
?>

</body>
</html>
