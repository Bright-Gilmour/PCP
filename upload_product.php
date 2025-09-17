<?php
// Connect to Database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "market";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start session and get vendor info
session_start();
$vendor_id = isset($_SESSION['vendor_id']) ? $_SESSION['vendor_id'] : null;
$vendor_name = isset($_SESSION['vendor_name']) ? $_SESSION['vendor_name'] : null;

if (!$vendor_id || !$vendor_name) {
    die("Error: Vendor information is missing. Please login again.");
}

// Get form data
$product_name = $_POST['product_name'];
$description = $_POST['description'];
$price = $_POST['price'];
$telephone = $_POST['telephone'];
$location = $_POST['location']; // Region selected

// Handle file upload
if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0) {
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $original_file_name = basename($_FILES["product_image"]["name"]);
    $unique_file_name = time() . "_" . $original_file_name;
    $target_file = $target_dir . $unique_file_name;

    if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
        // Insert into Database with vendor_name, telephone, and location
        $sql = "INSERT INTO products (vendor_id, vendor_name, product_name, description, price, image_path, telephone, location)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssdsis", $vendor_id, $vendor_name, $product_name, $description, $price, $unique_file_name, $telephone, $location);

        if ($stmt->execute()) {
            echo "Product uploaded successfully!";
            header("Location: vendor.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
} else {
    echo "No file uploaded or upload error.";
}

$conn->close();
?>
