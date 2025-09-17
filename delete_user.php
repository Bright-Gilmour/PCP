<?php
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $conn = new mysqli("localhost", "root", "", "market");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: customer.php"); // replace with your table page
        exit();
    } else {
        echo "Error deleting user.";
    }

    $stmt->close();
    $conn->close();
}
?>
