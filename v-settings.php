<?php
// Start the session
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "market");

// Check if the user is logged in
if (!isset($_SESSION['vendor_id'])) {
    die("Vendor not logged in.");
}

$vendor_id = $_SESSION['vendor_id'];

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $vendor_name = $_POST['vendor_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

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

    // Update vendor data in the database
    if ($image_name != "") {
        // Update with new profile image
        $sql = "UPDATE vendors SET vendor_name=?, email=?, password=?, profile_picture=? WHERE vendor_id=?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $vendor_name, $email, $password, $image_name, $vendor_id);
    } else {
        // Update without new profile image
        $sql = "UPDATE vendors SET vendor_name=?, email=?, password=? WHERE vendor_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $vendor_name, $email, $password, $vendor_id);
    }

    if ($stmt->execute()) {
        $_SESSION['message'] = "Vendor Profile updated successfully!";
    } else {
        $_SESSION['message'] = "Error updating profile.";
    }
}

// Fetch vendor data for pre-populating the form
$sql = "SELECT * FROM vendors WHERE vendor_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $vendor_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $vendor = $result->fetch_assoc();
} else {
    die("Vendor not found.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Settings Page</title>
    <style>
        .message {
            padding: 10px;
            margin: 10px 0;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: none;
            z-index: 1000;
        
        }
        .success {
            background-color: #d4edda;
            color:rgb(0, 0, 0);
            z-index: 1000;
            width: 20%;
            height: 4vh;
            margin-left: 40%;
            margin-top: -3%;
            
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
    <link rel="stylesheet" href="user.css">
</head>
<body style="width: 100%;height: 100vh;   background:
  url(https://i.ibb.co/Qjt7TJn/milad-fakurian-E8-Ufcyxz514-unsplash-1.jpg)
  center / cover no-repeat fixed; position: fixed; background-repeat: no-repeat; background-size: cover;">

<h2 style="margin-left: 42%; margin-top: 2%; color: white;">Vendor Profile Settings</h2>

<?php if (isset($_SESSION['message'])): ?>
    <div class="message <?php echo strpos($_SESSION['message'], 'Error') !== false ? 'error' : 'success'; ?>" id="message">
        <?php echo $_SESSION['message']; ?>
    </div>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<form id="setting-box"  action="v-settings.php" method="POST" enctype="multipart/form-data">
    <label>Vendor Name:</label><br>
    <input type="text" name="vendor_name" value="<?php echo htmlspecialchars($vendor['vendor_name']); ?>" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?php echo htmlspecialchars($vendor['email']); ?>" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" value="<?php echo htmlspecialchars($vendor['password']); ?>" required><br><br>

    <label>Profile Image:</label><br>
<?php if (!empty($vendor['profile_picture'])): ?>
    <img src="uploads/<?php echo htmlspecialchars($vendor['profile_picture']); ?>" width="100"><br>
<?php endif; ?>
<input type="file" name="profile_image"><br><br>

    <button type="submit">Update Profile</button>
</form>

<script>
    window.onload = function() {
        var message = document.getElementById("message");
        if (message) {
            message.style.display = "block";
            setTimeout(function() {
                message.style.display = "none";
            }, 5000);
        }
    };
</script>

</body>
</html>
