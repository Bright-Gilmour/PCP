<?php
$conn = new mysqli("localhost", "root", "", "market");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if vendor_id is passed
if (isset($_GET['vendor_id'])) {
    $vendor_id = $_GET['vendor_id'];

    // Fetch vendor details
    $sql = "SELECT * FROM vendors WHERE vendor_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $vendor_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $vendor = $result->fetch_assoc();
} else {
    die("Vendor ID not specified.");
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vendor_name = $_POST['vendor_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Update vendor details
    $update_sql = "UPDATE vendors SET vendor_name = ?, email = ?, password = ? WHERE vendor_id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("sssi", $vendor_name, $email, $password, $vendor_id);

    if ($stmt->execute()) {
        echo "<script>alert('Vendor updated successfully.'); window.location.href='vendors-list.php';</script>";
        exit;
    } else {
        echo "Error updating vendor: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Vendor</title>
</head>
<body>
    <h2>Edit Vendor</h2>
    <form method="POST">
        <label>Vendor Name:</label><br>
        <input type="text" name="vendor_name" value="<?= htmlspecialchars($vendor['vendor_name']) ?>" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?= htmlspecialchars($vendor['email']) ?>" required><br><br>

        <label>Password:</label><br>
        <input type="text" name="password" value="<?= htmlspecialchars($vendor['password']) ?>" required><br><br>

        <button type="submit">Update Vendor</button>
    </form>
</body>
</html>

<?php $conn->close(); ?>
