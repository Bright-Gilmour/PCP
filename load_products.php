<?php
$conn = new mysqli("localhost", "root", "", "market");

$filter = $_GET['filter'] ?? 'all';
$search = $_GET['search'] ?? '';

// Base query
$query = "SELECT image_path, vendor_name, product_name, price, description FROM products WHERE 1";

// Apply search filter
if (!empty($search)) {
    $safe_search = $conn->real_escape_string($search);
    $query .= " AND (product_name LIKE '%$safe_search%' OR vendor_name LIKE '%$safe_search%' OR description LIKE '%$safe_search%')";
}

// Apply radio filter
if ($filter === 'latest') {
    $query .= " ORDER BY id DESC LIMIT 10";
} elseif ($filter === 'old') {
    $query .= " ORDER BY id ASC LIMIT 10";
}

$result = $conn->query($query);

$base_url = 'http://localhost/SSS';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $image_path = htmlspecialchars($row['image_path']);
        $vendor_name = htmlspecialchars($row['vendor_name']);
        $product_name = htmlspecialchars($row['product_name']);
        $price = htmlspecialchars($row['price']);
        $description = htmlspecialchars($row['description']);
        $image_full_path = $base_url . '/uploads/' . $image_path;

        echo '<div class="product-box">
                <div class="items">
                    <img src="' . $image_full_path . '" alt="Product Image" style="width: 100px;">
                </div>
                <div><span><strong>Vendor:</strong> ' . $vendor_name . '</span></div>
                <hr>
                <div class="paymentss">
                    <span><strong>Product:</strong> ' . $product_name . '</span>
                    <div class="detailss">
                        <p><strong>Description:</strong> ' . $description . '</p>
                        <p><strong>Price:</strong> ₵' . $price . '</p>
                    </div>
                </div>
                <hr>
                <label>Qty:</label>
                <input type="number" class="quantity-input" value="1" min="1" style="width: 50px;">
                <button class="add-to-cart-btn"
                    data-name="' . $product_name . '"
                    data-price="' . $price . '"
                    data-image="' . $image_path . '">
                    ADD TO CART
                </button>
              </div>';
    }
} else {
    echo "<p>No products found.</p>";
}
?>
