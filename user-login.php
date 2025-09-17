<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "market";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        echo "Both fields are required.";
    } else {
        // Fetch id, firstname, and password
        $stmt = $conn->prepare("SELECT id, firstname, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($user_id, $firstname, $db_password);
            $stmt->fetch();

            // Compare plain text password (for now)
            if ($password === $db_password) {
                // Store info in session
                $_SESSION['user_id'] = $user_id;
                $_SESSION['email'] = $email;
                $_SESSION['firstname'] = $firstname;

                header("Location: user-dashboard.php");
                exit();
            } else {
                echo "Incorrect password.";
            }
        } else {
            echo "No account found with this email.";
        }

        $stmt->close();
    }
}

$conn->close();
?>
