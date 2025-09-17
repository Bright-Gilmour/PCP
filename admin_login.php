<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "market"; // Change if your DB name is different

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Fetch admin by email
    $stmt = $conn->prepare("SELECT id, email, password, name FROM admin WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();
        
        // Verify password
        if ($password === $admin['password']) {
            // Store admin info in session
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['name'];
            $_SESSION['admin_email'] = $admin['email'];
            
            header("Location: admin-dashb.php");
            exit();
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "Admin not found.";
    }

    $stmt->close();
}

$conn->close();
?>
