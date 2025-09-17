<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Product Page</title>
  
 
  <link rel="stylesheet" href="edit.css" />
  <script src="https://cdn.tailwindcss.com"></script>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.5.0/echarts.min.js"></script>

  <style>
    body {
      margin: 0;
      padding: 0;
    }

    .product-page {
      margin-top: 80px; /* Moves product section below the fixed nav */
    }

    /* Remove any red background from product card or icons */
    .ri-heart-line {
      background: none !important;
    }
  </style>
</head>

<body class="bg-gray-100">
  <main class="product-page">

    <!-- Navigation -->
    <nav class="sell-nav bg-white shadow fixed w-full z-50 top-0">
      <div class="navbar">
        <div class="container nav-container flex items-center justify-between p-4">
          <h4 style="font-size: 35px; margin-left: 5%; color: orangered;" class="text-xl font-bold">Products Dashboard</h4>
          <div class="menu-items flex gap-4">
            <a href="home.html" class="text-gray-600 hover:text-black">
              <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 24 24">
                <path d="M12 2C17.52 2 22 6.48 22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12C2 6.48 6.48 2 12 2ZM12 11V8L8 12L12 16V13H16V11H12Z" />
              </svg>
            </a>
          </div>
        </div>
      </div>
    </nav>

    <!-- Product Grid -->
    <?php
      $conn = mysqli_connect("localhost", "root", "", "market");
      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }
      $sql = "SELECT * FROM products";
      $result = mysqli_query($conn, $sql);
    ?>

    <section class="p-6">
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <?php 
          $base_url = 'http://localhost/SSS';
          while ($row = mysqli_fetch_assoc($result)):
          $image_path = $base_url . '/uploads/' . htmlspecialchars($row['image_path']);
          $server_path = __DIR__ . '/uploads/' . $row['image_path'];
        ?>
        <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col">
          <div class="relative">
            <?php if (!empty($row['image_path']) && file_exists($server_path)): ?>
              <img class="h-40 w-full object-cover" src="<?= $image_path ?>" alt="<?= htmlspecialchars($row['product_name']) ?>">
            <?php else: ?>
              <img class="h-40 w-full object-cover" src="<?= $base_url ?>/uploads/default.jpg" alt="Default Image">
            <?php endif; ?>
            <button class="absolute top-2 right-2 p-2 bg-white hover:bg-white rounded-full shadow-md hover:text-red-500 focus:outline-none">
              <i class="ri-heart-line"></i>
            </button>
          </div>

          <div class="p-4 flex-grow">
            <p class="font-bold text-black text-sm"><?= htmlspecialchars($row['vendor_name']); ?></p>
            <p style="font-weight: bolder; font-size: 15px; color: black;" class="text-xs text-gray-600"><strong>Product Name:</strong> <?= htmlspecialchars($row['product_name']); ?></p>
            <p style="font-weight: bolder; font-size: 15px; font-family: 'Times New Roman', Times, serif;" class="text-xs text-gray-600"><strong>Description:</strong> <?= htmlspecialchars($row['description']); ?></p>
            <p style="font-weight: bolder; font-size: 15px; color: black;" class="text-xs text-gray-600"><strong>Telephone:</strong> <?= htmlspecialchars($row['telephone']); ?></p>
            <p style="font-weight: bolder; font-size: 15px; color: black;" class="text-xs text-gray-600"><strong>Location:</strong> <?= htmlspecialchars($row['location']); ?></p>
            <div style="font-weight: bolder; font-size: 20px; color: black;" class="mt-2 text-sm font-medium text-black"><strong>Price:</strong> GH₵ <?= number_format($row['price'], 2); ?></div>
          </div>

          <form action="delete_product.php" method="POST" class="p-4 pt-0">
            <input type="hidden" name="id" value="<?= $row['id']; ?>">
            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-1 px-4 rounded text-sm">Delete</button>
          </form>
        </div>
        <?php endwhile; ?>
      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white border-t mt-20">
      <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
          
          <div>
          
          </div>
          <div>
         
          </div>
          <div>
           
          </div>
          <div>
          
            <div class="mt-6">
             
            </div>
          </div>
        </div>
        <div class="mt-12 pt-8 border-t text-center text-sm text-gray-600">
          <p>&copy; 2025 Price Comparison Platform. All rights reserved.</p>
        </div>
      </div>
    </footer>
  </main>
</body>
</html>
