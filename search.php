<?php
// Connect to the database
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'market';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the search query
$searchTerm = '';
if (isset($_GET['query'])) {
    $searchTerm = $conn->real_escape_string($_GET['query']);
}

// Pagination setup
$productsPerPage = 8;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max(1, $page); // Ensure page >= 1
$offset = ($page - 1) * $productsPerPage;

// Count total results
$countSql = "SELECT COUNT(*) AS total FROM products WHERE 
        product_name LIKE '%$searchTerm%' OR 
        vendor_name LIKE '%$searchTerm%' OR 
        description LIKE '%$searchTerm%'";
$countResult = $conn->query($countSql);
$totalProducts = ($countResult) ? $countResult->fetch_assoc()['total'] : 0;
$totalPages = ceil($totalProducts / $productsPerPage);

// Fetch products
$sql = "SELECT * FROM products WHERE 
        product_name LIKE '%$searchTerm%' OR 
        vendor_name LIKE '%$searchTerm%' OR 
        description LIKE '%$searchTerm%'
        LIMIT $productsPerPage OFFSET $offset";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Search Results</title>
  <style>
    body {
      width: 100%;
      background:rgb(255, 255, 255);
      min-height: 100vh;
      padding: 10px;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    .products {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 15px;
      padding: 10px;
    }

    .product-box {
      border: 1px solid #ccc;
      padding: 8px;
      text-align: center;
      background: #fff;
      border-radius: 6px;
      font-size: 14px;
      max-width: 320px;
      margin: auto;
      box-shadow: 1px 1px 10px 1px rgba(150, 150, 150, 0.67);
    }

    .product-box img {
      max-width: 100%;
      height: 100px;
      object-fit: cover;
      border-radius: 4px;
      margin-bottom: 8px;
    }

    .pagination {
      margin-top: 20px;
      text-align: center;
    }

    .pagination a {
      padding: 6px 10px;
      margin: 0 4px;
      text-decoration: none;
      border: 1px solid #ccc;
      color: #333;
      font-size: 14px;
    }

    .pagination a.active {
      background-color: #333;
      color: white;
    }

    .pagination a:hover {
      background-color: #666;
      color: white;
    }

    .back-button {
      display: block;
      width: 200px;
      margin: 20px auto;
      padding: 10px;
      background-color: #444;
      color: white;
      text-align: center;
      border: none;
      border-radius: 5px;
      text-decoration: none;
      font-size: 14px;
      cursor: pointer;
    }

    .back-button:hover {
      background-color: #666;
    }

    .no-result {
      text-align: center;
      margin-top: 40px;
    }

    .no-result img {
      width: 25%;
      margin-bottom: 10px;
    }

    .no-result h1 {
      color: red;
    }
  </style>
</head>
<body>

  <!-- Back to dashboard always visible -->
  <a href="user-dashboard.php" class="back-button">Back to All Products</a>

  <?php if ($result && $result->num_rows > 0): ?>
    <div class="products">
      <?php
      $base_url = 'http://localhost/SSS';
      while ($row = $result->fetch_assoc()) {
          $image_path = $base_url . '/uploads/' . htmlspecialchars($row['image_path']);
          echo '<div class="product-box">';
          echo '<img src="' . $image_path . '" alt="' . htmlspecialchars($row['product_name']) . '">';
          echo '<h3>' . htmlspecialchars($row['product_name']) . '</h3>';
          echo '<p>Price: GHS' . htmlspecialchars($row['price']) . '</p>';
          echo '<p>Vendor: ' . htmlspecialchars($row['vendor_name']) . '</p>';
          echo '<p>' . htmlspecialchars($row['description']) . '</p>';
          echo '<p>Location: ' . htmlspecialchars($row['location']) . '</p>';
          echo '<p>Telephone: ' . htmlspecialchars($row['telephone']) . '</p>';
          echo '</div>';
      }
      ?>
    </div>
  <?php else: ?>
    <div class="no-result">
      <img src="pic/cancel1.png" alt="No result">
      <h1>Sorry, we don't have "<?php echo htmlspecialchars($searchTerm); ?>" available now</h1>
    </div>
  <?php endif; ?>

  <!-- Pagination -->
  <?php if ($totalPages > 1): ?>
    <div class="pagination">
      <?php if ($page > 1): ?>
        <a href="?query=<?php echo urlencode($searchTerm); ?>&page=<?php echo $page - 1; ?>">&laquo; Prev</a>
      <?php endif; ?>

      <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a class="<?php echo ($i == $page) ? 'active' : ''; ?>" href="?query=<?php echo urlencode($searchTerm); ?>&page=<?php echo $i; ?>">
          <?php echo $i; ?>
        </a>
      <?php endfor; ?>

      <?php if ($page < $totalPages): ?>
        <a href="?query=<?php echo urlencode($searchTerm); ?>&page=<?php echo $page + 1; ?>">Next &raquo;</a>
      <?php endif; ?>
    </div>
  <?php endif; ?>

</body>
</html>

<?php $conn->close(); ?>
