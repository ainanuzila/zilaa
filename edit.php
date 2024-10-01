<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'your_database');

    // Fetch the student's current data
    $sql = "SELECT * FROM students WHERE id = '$id'";
    $result = $conn->query($sql);
    $student = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];

    // Handle file upload for the photo
    if ($_FILES['foto']['name']) {
        $foto = $_FILES['foto']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($foto);
        move_uploaded_file($_FILES['foto']['tmp_name'], $target_file);
    } else {
        $foto = $_POST['existing_foto'];
    }

    // Update the student's data
    $sql = "UPDATE students SET nama = '$nama', kelas = '$kelas', foto = '$foto' WHERE id = '$id'";
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
    <title>Edit Student</title>
</head>
<body>
    <h1>Edit Student</h1>
    <form action="edit.php?id=<?= $student['id'] ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $student['id'] ?>">

        <label for="nama">Name:</label>
        <input type="text" name="nama" id="nama" value="<?= $student['nama'] ?>" required><br>

        <label for="kelas">Class:</label>
        <input type="text" name="kelas" id="kelas" value="<?= $student['kelas'] ?>" required><br>

        <label for="foto">Photo:</label>
        <input type="file" name="foto" id="foto" accept="image/*"><br>
        <input type="hidden" name="existing_foto" value="<?= $student['foto'] ?>">

        <button type="submit">Save</button>
    </form>
    <a href="index.php">Exit</a>
</body>
</html>
