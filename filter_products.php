<?php
$conn = new mysqli("localhost", "root", "", "market");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$base_url = 'http://localhost/SSS';
$filter = $_POST['filter'] ?? 'all'; // Default filter is 'all'

$order_by = 'id DESC'; // Default to 'Latest Goods' (newest first)
if ($filter === 'latest') {
    $order_by = 'id DESC'; // Most recent first
} elseif ($filter === 'old') {
    $order_by = 'id ASC'; // Oldest first
} elseif ($filter === 'all') {
    // Show all goods with no specific order
    $order_by = 'id DESC';
}

$sql = "SELECT vendor_name, product_name, description, price, telephone, location, image_path FROM products ORDER BY $order_by";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $image_path = $base_url . '/uploads/' . htmlspecialchars($row['image_path']);
        echo '
        <div class="product-box" style="border: 1px solid #ccc; padding: 15px; border-radius: 8px; background: #fff; box-shadow: 0 0 5px rgba(0,0,0,0.1);">
            <div class="items" style="text-align: center;">
                <img src="' . $image_path . '" alt="Product Image" style="width: 100px; height: auto;">
            </div>
            <div style="margin-top: 10px;">
                <span><strong>Vendor:</strong> ' . htmlspecialchars($row['vendor_name']) . '</span>
            </div>
            <hr>
            <div class="paymentss">
                <span><strong>Product:</strong> ' . htmlspecialchars($row['product_name']) . '</span>
                <div class="detailss" style="margin-top: 5px;">
                    <span><strong>Description:</strong> ' . htmlspecialchars($row['description']) . '</span><br>
                    <span><strong>Price:</strong> ₵' . htmlspecialchars($row['price']) . '</span><br>
                    <span><strong>Telephone:</strong> ' . htmlspecialchars($row['telephone']) . '</span><br>
                    <span><strong>Location:</strong> ' . htmlspecialchars($row['location']) . '</span>
                </div>
            </div>
        </div>';
    }
} else {
    echo "<p>No products found.</p>";
}
?>
