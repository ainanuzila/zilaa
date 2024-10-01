<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];

    // Handle photo upload
    $foto = $_FILES['foto']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($foto);
    move_uploaded_file($_FILES['foto']['tmp_name'], $target_file);

    // Connect to the database
    $conn = new mysqli('localhost', 'root', '0127', 'zila');

    // Insert the data into the students table
    $sql = "INSERT INTO students (nama, kelas, foto) VALUES ('$nama', '$kelas', '$foto')";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Student</title>
</head>
<body>
    <h1>Add New Student</h1>
    <form action="add.php" method="post" enctype="multipart/form-data">
        <label for="nama">Name:</label>
        <input type="text" name="nama" id="nama" required><br>

        <label for="kelas">Class:</label>
        <input type="text" name="kelas" id="kelas" required><br>

        <label for="foto">Photo:</label>
        <input type="file" name="foto" id="foto" accept="image/*" required><br>

        <button type="submit">Send</button>
    </form>
    <a href="index.php">Exit</a>
</body>
</html>