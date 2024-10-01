<?php
// Include the database configuration file
include 'config.php';

// Fetch all records from the `students` table
$sql = "SELECT * FROM students";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student List</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 8px 12px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Student List</h1>
    <a href="add.php">Add New Student</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Class</th>
            <th>Photo</th>
            <th>Actions</th>
        </tr>
        <!-- Loop through the records and display them -->
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['id']) ?></td>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td><?= htmlspecialchars($row['kelas']) ?></td>
            <td><img src="uploads/<?= htmlspecialchars($row['foto']) ?>" alt="photo" width="50"></td>
            <td>
                <a href="edit.php?id=<?= htmlspecialchars($row['id']) ?>">Edit</a> |
                <a href="del.php?id=<?= htmlspecialchars($row['id']) ?>" onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
<?php
} else {
    echo "<h2>No students found.</h2>";
}
$conn->close();
?>
</body>
</html>
