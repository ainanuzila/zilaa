<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'your_database');

    // Delete the student record
    $sql = "DELETE FROM students WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
