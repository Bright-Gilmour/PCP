<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}

$user_id = $_SESSION['user_id']; // Correct session key

// Connect to database
$conn = new mysqli("localhost", "root", "", "market");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Split fullname into firstname and lastname
    $name_parts = explode(" ", $fullname, 2);
    $firstname = $name_parts[0];
    $lastname = isset($name_parts[1]) ? $name_parts[1] : "";

    // Handle profile image upload
    $image_name = "";
    if (!empty($_FILES['profile_image']['name'])) {
        $image_name = uniqid() . "_" . basename($_FILES['profile_image']['name']);
        move_uploaded_file($_FILES['profile_image']['tmp_name'], "uploads/" . $image_name);
    }

    // Update user data
    if ($image_name != "") {
        $sql = "UPDATE users SET firstname=?, lastname=?, email=?, password=?, profile_image=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $firstname, $lastname, $email, $password, $image_name, $user_id);
    } else {
        $sql = "UPDATE users SET firstname=?, lastname=?, email=?, password=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $firstname, $lastname, $email, $password, $user_id);
    }

    if ($stmt->execute()) {
        echo "Profile updated successfully!";
    } else {
        echo "Error updating profile.";
    }

    $stmt->close();
}

// Fetch user data
$sql = "SELECT * FROM users WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    die("User not found.");
}
?>
