<?php
session_start();

// Connect to your database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "market";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    // Check if email exists
    $stmt = $conn->prepare("SELECT vendor_id, vendor_name, password FROM vendors WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Direct comparison since password is stored as plain text
        if ($password === $row['password']) {
            $_SESSION['vendor_id'] = $row['vendor_id'];
            $_SESSION['vendor_name'] = $row['vendor_name'];

            header("Location: vendor.php");
            exit();
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "No account found with that email!";
    }

    $stmt->close();
}

$conn->close();
?>
