<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $product_id = intval($_POST['id']);


    // Connect to database
    $conn = new mysqli('localhost', 'root', '', 'market');

    if ($conn->connect_error) {
        echo 'error';
        exit();
    }

    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);

    if ($stmt->execute()) {
        // Redirect to product.php after successful deletion
        header("Location: product.php");
        exit();
    } else {
        echo 'error';
    }

    $stmt->close();
    $conn->close();
}
?>
