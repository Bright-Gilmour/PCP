<?php
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $conn_top = new mysqli("localhost", "root", "", "market");
    if ($conn_top->connect_error) {
        die("Connection failed: " . $conn_top->connect_error);
    }

    // Fetch updated firstname and profile image from database
    $sql = "SELECT firstname, profile_image FROM users WHERE id = ?";
    $stmt = $conn_top->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($firstname, $profile_image);
    $stmt->fetch();

    $profile_pic_path = !empty($profile_image) ? "uploads/" . $profile_image : "pic/user.png";

    $conn_top->close();
} else {
    header("Location: login.php");
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="user.css">
    <link rel="stylesheet" href="code-edit.css">
    <link rel="stylesheet" href="search.css">
    <style>
      .product-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    padding: 10px;
}

        .product-box {
    width: 300px; /* Or 100%, or any value you want */
    margin: 10px auto;
}


        .items img {
            width: 100px;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .detailss span {
            display: block;
            margin-top: 4px;
        }
    </style>
</head>
<body>

    <main class="user-dashboard">

    <nav class="navbar-box">
<form method="GET" action="search.php">
  <div class="group">
    <svg viewBox="0 0 24 24" aria-hidden="true" class="icon">
      <g>
        <path
          d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"
        ></path>
      </g>
    </svg>
    <input
      class="input"
      type="search"
      name="query"
      placeholder="Search"
      required
    />
  </div>
</form>
    </nav>
   
        <aside class="left-box">

<section class="pic-box">
<img src="<?php echo htmlspecialchars($profile_pic_path); ?>" alt="Profile Picture">

    <h3>Name: <?php echo htmlspecialchars($firstname); ?></h3>
</section>

            <div class="box-inside1">
     
<div class="input7">
  <a href="#" class="value7">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
      <path d="M3 12C3 12.5523 3.44772 13 4 13H10C10.5523 13 11 12.5523 11 12V4C11 3.44772 10.5523 3 10 3H4C3.44772 3 3 3.44772 3 4V12ZM3 20C3 20.5523 3.44772 21 4 21H10C10.5523 21 11 20.5523 11 20V16C11 15.4477 10.5523 15 10 15H4C3.44772 15 3 15.4477 3 16V20ZM13 20C13 20.5523 13.4477 21 14 21H20C20.5523 21 21 20.5523 21 20V12C21 11.4477 20.5523 11 20 11H14C13.4477 11 13 11.4477 13 12V20ZM14 3C13.4477 3 13 3.44772 13 4V8C13 8.55228 13.4477 9 14 9H20C20.5523 9 21 8.55228 21 8V4C21 3.44772 20.5523 3 20 3H14Z"></path>
    </svg>
    Dashboard
  </a>

  <a href="setting-page.php" class="value7">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
      <path d="M2 18H9V20H2V18ZM2 11H11V13H2V11ZM2 4H22V6H2V4ZM20.674 13.0251L21.8301 12.634L22.8301 14.366L21.914 15.1711C21.9704 15.4386 22 15.7158 22 16C22 16.2842 21.9704 16.5614 21.914 16.8289L22.8301 17.634L21.8301 19.366L20.674 18.9749C20.2635 19.3441 19.7763 19.6295 19.2391 19.8044L19 21H17L16.7609 19.8044C16.2237 19.6295 15.7365 19.3441 15.326 18.9749L14.1699 19.366L13.1699 17.634L14.086 16.8289C14.0296 16.5614 14 16.2842 14 16C14 15.7158 14.0296 15.4386 14.086 15.1711L13.1699 14.366L14.1699 12.634L15.326 13.0251C15.7365 12.6559 16.2237 12.3705 16.7609 12.1956L17 11H19L19.2391 12.1956C19.7763 12.3705 20.2635 12.6559 20.674 13.0251ZM18 18C19.1046 18 20 17.1046 20 16C20 14.8954 19.1046 14 18 14C16.8954 14 16 14.8954 16 16C16 17.1046 16.8954 18 18 18Z"></path>
    </svg>
    Settings
  </a>
</div>

            </div>

            <div class="log-out-box">

               <button1 onclick="goOut()">
                  <div class="svg-wrapper-1">
                    <div class="svg-wrapper">
                     <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M5 11H13V13H5V16L0 12L5 8V11ZM3.99927 18H6.70835C8.11862 19.2447 9.97111 20 12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C9.97111 4 8.11862 4.75527 6.70835 6H3.99927C5.82368 3.57111 8.72836 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C8.72836 22 5.82368 20.4289 3.99927 18Z"></path></svg>
                    </div>
                  </div>
                  <span>Logout</span>
                </button1>
                
            </div>

        </aside>

        <div class="slide-box">

            <div class="slideshow-container">
                <img class="slides" src="pic/image1.jpg" alt="Slide 1">
                <img class="slides" src="pic/image2.jpg" alt="Slide 2">
                <img class="slides" src="pic/image3.jpg" alt="Slide 3">
                <img class="slides" src="pic/image4.jpg" alt="Slide 4">
                <img class="slides" src="pic/image5.jpg" alt="Slide 5">
                <img class="slides" src="pic/image6.jpg" alt="Slide 6">
                <img class="slides" src="pic/image7.jpg" alt="Slide 7">
              </div>
              <div class="dot-container">
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>

        </div>

        <div class="goods-box">

        <div class="radio-inputs2">

    <label class="radio2">
      <input type="radio" name="filter" value="all" checked>
      <span class="name2">All Goods</span>
    </label>
    <label class="radio2">
      <input type="radio" name="filter" value="latest">
      <span class="name2">Latest Goods</span>
    </label>
    <label class="radio2">
      <input type="radio" name="filter" value="old">
      <span class="name2">Old Goods</span>
    </label>

        </div>


  <!-- user css -->
        </div>
        
        <section class="layout">

    <div class="grow1">
        <div class="cards carts">
            <div class="stepss">
                <div class="product-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; padding: 10px;">
<?php
$conn = new mysqli("localhost", "root", "", "market");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$base_url = 'http://localhost/SSS';
$sql = "SELECT vendor_name, product_name, description, price, telephone, location, image_path FROM products";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $image_path = $base_url . '/uploads/' . htmlspecialchars($row['image_path']);
?>
        <!-- Individual product box -->
        <div class="product-box" style="border: 1px solid #ccc; padding: 15px; border-radius: 8px; background: #ff6262; box-shadow: 0 0 5px rgba(0,0,0,0.1);">
            <div class="items" style="text-align: center;">
                <img src="<?php echo $image_path; ?>" alt="Product Image" style="width: 100px; height: auto;">
            </div>
            <div style="margin-top: 10px;">
                <span><strong>Vendor:</strong> <?php echo htmlspecialchars($row['vendor_name']); ?></span>
            </div>
            <hr>
            <div class="paymentss">
                <span><strong>Product:</strong> <?php echo htmlspecialchars($row['product_name']); ?></span>
                <div class="detailss" style="margin-top: 5px;">
                    <span><strong>Description:</strong> <?php echo htmlspecialchars($row['description']); ?></span><br>
                    <span><strong>Price:</strong> ₵<?php echo htmlspecialchars($row['price']); ?></span><br>
                    <span><strong>Telephone:</strong> <?php echo htmlspecialchars($row['telephone']); ?></span><br>
                    <span><strong>Location:</strong> <?php echo htmlspecialchars($row['location']); ?></span>
                </div>
            </div>
        </div>
<?php
    }
} else {
    echo "<p>No products found.</p>";
}
?>

                </div> <!-- .product-grid -->
            </div> <!-- .stepss -->
        </div> <!-- .cards carts -->
    </div> <!-- .grow1 -->
</section>
s
    </main>
    
    <script src="code.js"></script>
    <script>
document.querySelectorAll('input[name="filter"]').forEach(radio => {
    radio.addEventListener('change', function () {
        const filter = this.value;  // Get the selected filter value (all, latest, old)

        fetch('filter_products.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'filter=' + encodeURIComponent(filter)  // Send the filter value to PHP
        })
        .then(response => response.text())
        .then(data => {
            document.querySelector('.product-grid').innerHTML = data;  // Update the product grid
        });
    });
});
</script>


</body>
</html>