<?php
session_start();

// Connect to the database
$conn = new mysqli("localhost", "root", "", "market");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check admin login session
if (!isset($_SESSION['admin_id'])) {
    die("Admin not logged in.");
}

$admin_id = $_SESSION['admin_id'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $password = $_POST['password'];

    // Handle profile picture upload
    $image_name = "";
    if (!empty($_FILES['profile_image']['name'])) {
        $image_name = uniqid() . "_" . basename($_FILES['profile_image']['name']);
        $upload_dir = "uploads/";
        $upload_path = $upload_dir . $image_name;

        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        if (!move_uploaded_file($_FILES['profile_image']['tmp_name'], $upload_path)) {
            $_SESSION['message'] = "Error uploading image.";
        }
    }

    // Update admin info
    if ($image_name != "") {
        $sql = "UPDATE admin SET name = ?, email = ?, password = ?, profile_picture = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $name, $email, $password, $image_name, $admin_id);
    } else {
        $sql = "UPDATE admin SET name = ?, email = ?, password = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $name, $email, $password, $admin_id);
    }

    if ($stmt->execute()) {
        $_SESSION['message'] = "Profile updated successfully!";
    } else {
        $_SESSION['message'] = "Error updating profile.";
    }

    $stmt->close();
}

// Fetch admin data
$sql = "SELECT * FROM admin WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $admin = $result->fetch_assoc();
} else {
    die("Admin not found.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Settings</title>
    <style>
        .message {
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            display: none;
        }
        .success { background-color: #d4edda; color: #155724; }
        .error { background-color: #f8d7da; color: #721c24; }
    </style>
    <link rel="stylesheet" href="admin.css">
</head>
<body class="admin-setting">

<h2 style="font-size: 30px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: white;">Admin Profile Settings</h2>

<?php if (isset($_SESSION['message'])): ?>
    <div class="message <?= strpos($_SESSION['message'], 'Error') !== false ? 'error' : 'success'; ?>" id="message">
        <?= $_SESSION['message']; ?>
    </div>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<form id="form-admin" action="admin-settings.php" method="POST" enctype="multipart/form-data">

    <label>Name:</label><br>
    <input type="text" name="name" value="<?= htmlspecialchars($admin['name']); ?>" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?= htmlspecialchars($admin['email']); ?>" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" value="<?= htmlspecialchars($admin['password']); ?>" required><br><br>

    <label>Profile Image:</label><br>
    <?php if (!empty($admin['profile_picture'])): ?>
        <img src="uploads/<?= htmlspecialchars($admin['profile_picture']); ?>" width="100"><br>
    <?php endif; ?>
    <input type="file" name="profile_image"><br><br>

    <button type="submit">Update Profile</button>
</form>

<script>
    window.onload = function () {
        var message = document.getElementById("message");
        if (message) {
            message.style.display = "block";
            setTimeout(function () {
                message.style.display = "none";
            }, 5000);
        }
    };
</script>

</body>
</html>
