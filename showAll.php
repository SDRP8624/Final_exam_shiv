<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>showAll</title>
    <link rel="icon" href="img\favicon.png" type="image/x-icon">
</head>
<body>
<?php include 'header.php'; ?>

<form method="post" action="showAll.php">
    <input type="number" name="string_id" required>
    <button type="submit" name="delete">Delete</button>
</form>

<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'final');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Display all records
$sql = "SELECT string_id, message FROM string_info";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row["string_id"] . " - Message: " . $row["message"] . "<br>";
    }
} else {
    echo "0 results";
}

// Handle deletion
if (isset($_POST['delete'])) {
    $string_id = $_POST['string_id'];

    // Prepared statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM string_info WHERE string_id = ?");
    $stmt->bind_param("i", $string_id);
    $stmt->execute();
    $stmt->close();
    echo "Record deleted.";
}

$conn->close();
?>

</body>
</html>

