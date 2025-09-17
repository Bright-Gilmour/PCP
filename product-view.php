<?php
session_start();

// Ensure the vendor is logged in
if (isset($_SESSION['vendor_id'])) {
    $vendor_id = $_SESSION['vendor_id'];
    
    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'market');
    
    // Check if the connection is successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch the vendor's name from the database
    $stmt = $conn->prepare("SELECT vendor_name FROM vendors WHERE vendor_id = ?");
    $stmt->bind_param("i", $vendor_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $vendor_name = $row['vendor_name'];
    } else {
        $vendor_name = "Unknown Vendor";  // In case no vendor is found
    }
    $stmt->close();

    // Fetch products for this vendor
    $stmt = $conn->prepare("SELECT * FROM products WHERE vendor_id = ?");
    $stmt->bind_param("i", $vendor_id);
    $stmt->execute();
    $result_products = $stmt->get_result();

    $products = [];
    if ($result_products->num_rows > 0) {
        while ($row = $result_products->fetch_assoc()) {
            $products[] = $row;
        }
    }
    $stmt->close();
    $conn->close();
} else {
    $vendor_name = "Guest";
    $products = [];
}

// Set the base URL for the project
$base_url = "http://localhost/sss";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Product View</title>
<style>
    .layout-product {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: flex-start;
        padding: 20px;
    }

    .grow1-product {
        flex: 0 0 calc(25% - 20px); /* 4 per row */
        box-sizing: border-box;
        min-height: 350px;
    }

    .card8 {
        background-color: #f2f2f2;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .card8:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .card-img8 {
        width: 100%;
        height: 200px;
        background-color: #f5f5f5;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .card-img8 img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        border-radius: 8px;
    }

    .card-info8 {
        padding: 15px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .text-title8 {
        font-weight: bold;
        font-size: 1.1rem;
        margin-bottom: 8px;
        color: #333;
    }

    .text-body8 {
        font-size: 0.9rem;
        color: #666;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        margin-bottom: 10px;
        flex-grow: 1;
    }

    .card-footer8 {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px;
        border-top: 1px solid #ddd;
        background-color: #eaeaea;
    }

    .card-button8 button {
        background-color: #e74c3c;
        color: white;
        padding: 8px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 0.9rem;
        transition: background-color 0.3s;
    }

    .card-button8 button:hover {
        background-color: #c0392b;
    }

    /* Responsive adjustments */
    @media (max-width: 1200px) {
        .grow1-product {
            flex: 0 0 calc(33.333% - 20px); /* 3 per row */
        }
    }

    @media (max-width: 900px) {
        .grow1-product {
            flex: 0 0 calc(50% - 20px); /* 2 per row */
        }

        .card-img8 {
            height: 180px;
        }
    }

    @media (max-width: 600px) {
        .grow1-product {
            flex: 0 0 100%; /* 1 per row */
        }

        .card-img8 {
            height: 220px;
        }
    }

    /* Empty state styling */
    .layout-product:empty::before {
        content: "No products available for this vendor.";
        display: block;
        width: 100%;
        text-align: center;
        padding: 40px;
        color: #666;
        font-size: 1.2rem;
    }
</style>

</head>
<body>

    <main class="view-product">

        <nav style="width: 100%; height: 8vh; background: #333;">
            <h1 style="position: absolute; margin-left: 5%; color: white; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;font-size: 30px; margin-top: 0.5%;">PRODUCT PAGE</h1>
            
        </nav>

        <h2 id="vendor-name">Vendor Name: <?= htmlspecialchars($vendor_name) ?></h2>

        <section class="layout-product">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <div class="grow1-product">
                        <div class="card8">
                            <div class="card-img8">
                                <?php
                                    // Set the correct image paths
                                    $image_path = $base_url . '/uploads/' . htmlspecialchars($product['image_path']);
                                    $server_path = __DIR__ . '/uploads/' . $product['image_path'];
                                ?>

                                <?php if (!empty($product['image_path']) && file_exists($server_path)): ?>
                              
    <img src="<?= $image_path ?>" alt="<?= htmlspecialchars($product['product_name']) ?>">

                                <?php else: ?>
                                    <img src="<?= $base_url ?>/uploads/default.jpg" alt="Default Image">
                                <?php endif; ?>
                            </div>

                            <div class="card-info8">
                                <p class="text-title8"><?= htmlspecialchars($product['product_name']) ?></p>
                                <p class="text-body8"><?= htmlspecialchars($product['description']) ?></p>
                            </div>
                            <div class="card-footer8">
                                <span class="text-title8">GHC<?= number_format($product['price'], 2) ?></span>
                                <div class="card-button8">
    <button class="delete-btn" data-id="<?= $product['id'] ?>">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24" width="24" height="24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7L5 7M10 11L10 17M14 11L14 17M5 7L6 19A2 2 0 008 21H16A2 2 0 0018 19L19 7M9 7V4H15V7" />
        </svg>
    </button>
</div>

               </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No products available for this vendor.</p>
            <?php endif; ?>
        </section>

    </main>
</body>
<script src="code.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-btn');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const productId = this.getAttribute('data-id');
            console.log('Delete button clicked for product ID:', productId);

            if (confirm('Are you sure you want to delete this product?')) {
                fetch('delete.php', {  // <-- Updated here
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'product_id=' + encodeURIComponent(productId)
                })
                .then(response => response.text())
                .then(result => {
                    console.log('Server response:', result);
                    if (result.trim() === 'success') {
                        const cardToRemove = this.closest('.grow1-product');
                        if (cardToRemove) {
                            cardToRemove.remove();
                            console.log('Product card removed from DOM');
                        } else {
                            console.error('Could not find product card container to remove.');
                        }
                    } else {
                        alert('Failed to delete product. Server says: ' + result);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while deleting the product.');
                });
            }
        });
    });
});

</script>

</html>
