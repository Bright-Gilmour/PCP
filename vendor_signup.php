<?php
// Connect to your database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "market";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection works
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vendor_name = htmlspecialchars(trim($_POST['vendor_name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $confirm_password = htmlspecialchars(trim($_POST['confirm_password']));

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
        exit();
    }

    // Insert plain password into database (⚠️ not secure)
    $stmt = $conn->prepare("INSERT INTO vendors (vendor_name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $vendor_name, $email, $password);

    if ($stmt->execute()) {
        echo "Vendor registration successful!";
        header("Location: vendor-log.html");
    } else {
        echo "Something went wrong. Please try again.";
    }
    $stmt->close();
}

$conn->close();
?>
