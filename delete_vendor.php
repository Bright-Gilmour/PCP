<?php
$conn = new mysqli("localhost", "root", "", "market");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['vendor_id'])) {
    $vendor_id = $_GET['vendor_id'];

    // Delete vendor
    $sql = "DELETE FROM vendors WHERE vendor_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $vendor_id);

    if ($stmt->execute()) {
        echo "<script>alert('Vendor deleted successfully.'); window.location.href='vendors-list.php';</script>";
    } else {
        echo "Error deleting vendor: " . $conn->error;
    }
} else {
    echo "Vendor ID not specified.";
}

$conn->close();
?>
