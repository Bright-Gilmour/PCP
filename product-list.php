<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="product.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="edit.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.5.0/echarts.min.js"></script>

</head>


<body>


    <main class="product-page">

        <nav class="sell-nav">
            <nav>
                <div class="navbar">
                  <div class="container nav-container">
                      <input class="checkbox" type="checkbox" name="" id="" />
                      <div class="hamburger-lines">
                        <span class="line line1"></span>
                        <span class="line line2"></span>
                        <span class="line line3"></span>
                      </div>  
                      <h4 id="product-title">Product List</h4>
                    <div class="logo">
                    </div>
                    <div class="menu-items">
                      <li><a href="home.html">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C17.52 2 22 6.48 22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12C2 6.48 6.48 2 12 2ZM12 11V8L8 12L12 16V13H16V11H12Z"></path></svg>
                      </a></li>
                    </div>
                   
                  </div>
                </div>
              </nav>
        </nav>







        <br>


        <?php
// Connect to database
$conn = mysqli_connect("localhost", "root", "", "market");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch products
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);
?>

<section class="sell-box">
    <div id="height-box" class="grid grid-cols-4 gap-6 px-4">

    <?php 
    $base_url = 'http://localhost/SSS';

    while ($row = mysqli_fetch_assoc($result)) {
        $image_path = $base_url . '/uploads/' . htmlspecialchars($row['image_path']);
        $server_path = __DIR__ . '/uploads/' . $row['image_path'];
    ?>
        <div>
            <div style="box-shadow:  1px 1px 10px 1px rgb(175, 175, 175);" class="relative">
                <?php if (!empty($row['image_path']) && file_exists($server_path)): ?>
                    <img src="<?= $image_path ?>" alt="<?= htmlspecialchars($row['product_name']) ?>">
                <?php else: ?>
                    <img src="<?= $base_url ?>/uploads/default.jpg" alt="Default Image">
                <?php endif; ?>

                <button class="absolute top-2 right-2 p-2 bg-white rounded-full shadow-md hover:text-primary">
                    <i class="ri-heart-line"></i>
                </button>
            </div>

            <div style="box-shadow:  1px 1px 10px 1px rgb(175, 175, 175);" class="p-4">
                <h3 class="text-gray-500" style="font-size: 14px; color: black; font-weight: bolder;">
                    <?= htmlspecialchars($row['vendor_name']); ?>
                </h3>

                <h4 class="text-gray-500" style="font-size: 12px; color: #555;">
                    <?= htmlspecialchars($row['product_name']); ?>
                </h4>
                <p style="font-size: 12px; color: #555;"><?= htmlspecialchars($row['description']); ?></p>

                <div class="mt-3 space-y-2">
                    <div class="flex items-center justify-between text-sm" style="font-size: 12px;">
                        <span class="text-gray-500" style="color: black;">Price</span>
                        <span class="font-medium">GHC<?= number_format($row['price'], 2); ?></span>
                    </div>

                    <div class="flex items-center justify-between text-sm" style="font-size: 12px;">
                        <span class="text-gray-500" style="color: black;">Telephone</span>
                        <span class="font-medium"><?= htmlspecialchars($row['telephone']); ?></span>
                    </div>

                    <div class="flex items-center justify-between text-sm" style="font-size: 12px;">
                        <span class="text-gray-500" style="color: black;">Location</span>
                        <span class="font-medium"><?= htmlspecialchars($row['location']); ?></span>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    </div>
</section>










                    
<footer style="margin-top: 680%;" id="white-box" class="bg-white border-t">
    <div class="max-w-7xl mx-auto px-4 py-12">
    <div class="grid grid-cols-4 gap-8">
   
    <div>
  
    </div>
    
    
    <div>
    
    <div class="flex space-x-4 text-gray-600">
    
    </div>
    <div class="mt-6">
    
    <div class="flex">
    
    </div>
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
<script src="code.js"></script>
</html>