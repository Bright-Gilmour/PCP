<?php
// Start the session
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "market");

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}

$user_id = $_SESSION['user_id'];

// Handle the form submission
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
        $upload_dir = "uploads/"; // Directory where the images will be uploaded
        $upload_path = $upload_dir . $image_name;

        // Move the uploaded image to the uploads directory
        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $upload_path)) {
            $_SESSION['message'] = "Image uploaded successfully!";
        } else {
            $_SESSION['message'] = "Error uploading image.";
        }
    }

    // Update user data in the database
    if ($image_name != "") {
        // Update with new profile image
        $sql = "UPDATE users SET firstname=?, lastname=?, email=?, password=?, profile_image=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $firstname, $lastname, $email, $password, $image_name, $user_id);
    } else {
        // Update without new profile image
        $sql = "UPDATE users SET firstname=?, lastname=?, email=?, password=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $firstname, $lastname, $email, $password, $user_id);
    }

    if ($stmt->execute()) {
        $_SESSION['message'] = "Profile updated successfully!";
    } else {
        $_SESSION['message'] = "Error updating profile.";
    }
}

// Fetch user data for pre-populating the form
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

<!DOCTYPE html>
<html>
<head>
    <title>Settings Page</title>
    <style>
        /* Styling for the message box */
        .message {
            padding: 10px;
            margin: 10px 0;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: none;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            
        }
    </style>
    <link rel="stylesheet" href="user.css">
</head>
<body style=" background-size: cover; background-position: center; background-repeat: no-repeat; width: 100%; height: 100vh; position: fixed;">

<h2 style="margin-left: 45%; margin-top: 2%;">Profile Settings</h2>

<?php if (isset($_SESSION['message'])): ?>
    <div class="message <?php echo strpos($_SESSION['message'], 'Error') !== false ? 'error' : 'success'; ?>" id="message">
        <?php echo $_SESSION['message']; ?>
    </div>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>

    
<form id="setting-box" action="setting-page.php" method="POST" enctype="multipart/form-data">
    <label>Full Name:</label><br>
    <input type="text" name="fullname" value="<?php echo htmlspecialchars($user['firstname'] . ' ' . $user['lastname']); ?>" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" value="<?php echo htmlspecialchars($user['password']); ?>" required><br><br>

    <label>Profile Image:</label><br>
    <?php if (!empty($user['profile_image'])): ?>
        <img src="uploads/<?php echo htmlspecialchars($user['profile_image']); ?>" width="100"><br>
    <?php endif; ?>
    <input type="file" name="profile_image"><br><br>

    <button type="submit">Update Profile</button>
</form>


<script>
    // If a message exists, show it and then hide it after 15 seconds
    window.onload = function() {
        var message = document.getElementById("message");
        if (message) {
            message.style.display = "block"; // Show message
            setTimeout(function() {
                message.style.display = "none"; // Hide message after 15 seconds
            }, 5000); // 15 seconds
        }
    };
</script>

</body>
</html>
