
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="vendor.css">
</head>
<body>

    <main class="vendor-page">


        <aside class="left-box2">
          <h3>VENDOR PAGE</h3>


          <?php
// Assuming session_start() is already called
$conn = new mysqli("localhost", "root", "", "market");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$profilePic = 'pic/user.png'; // Default image
$vendorName = 'Guest';

if (isset($_SESSION['vendor_id'])) {
    $vendor_id = $_SESSION['vendor_id'];

    // Make sure column name matches your DB structure
    $stmt = $conn->prepare("SELECT profile_picture, vendor_name FROM vendors WHERE vendor_id = ?");
    $stmt->bind_param("i", $vendor_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (!empty($row['profile_picture']) && file_exists("uploads/" . $row['profile_picture'])) {
            $profilePic = "uploads/" . $row['profile_picture'];
        }
        $vendorName = htmlspecialchars($row['vendor_name']);
    }

    $stmt->close();
}

$conn->close();
?>

<div id="picture-form">
  <img src="<?php echo $profilePic; ?>" alt="Profile Picture" style="width:100px; height:100px; object-fit:cover; border-radius:50%; margin-bottom: -20px;">
  <br>
  <h5 style="color: white; margin-top: 45%;">Name: <?php echo $vendorName; ?></h5>
</div>




            <div class="box-inside2">

        
<div class="input8">
    <button id="value8">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M3 12C3 12.5523 3.44772 13 4 13H10C10.5523 13 11 12.5523 11 12V4C11 3.44772 10.5523 3 10 3H4C3.44772 3 3 3.44772 3 4V12ZM3 20C3 20.5523 3.44772 21 4 21H10C10.5523 21 11 20.5523 11 20V16C11 15.4477 10.5523 15 10 15H4C3.44772 15 3 15.4477 3 16V20ZM13 20C13 20.5523 13.4477 21 14 21H20C20.5523 21 21 20.5523 21 20V12C21 11.4477 20.5523 11 20 11H14C13.4477 11 13 11.4477 13 12V20ZM14 3C13.4477 3 13 3.44772 13 4V8C13 8.55228 13.4477 9 14 9H20C20.5523 9 21 8.55228 21 8V4C21 3.44772 20.5523 3 20 3H14Z"></path></svg>
      Dashboard
    </button>

    <button id="value8" onclick="addProduct()">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M17.0047 16.0028H19.0047V4.00281H9.00468V6.00281H17.0047V16.0028ZM17.0047 18.0028V21.0019C17.0047 21.5547 16.5547 22.0028 15.9978 22.0028H4.01154C3.45548 22.0028 3.00488 21.5582 3.00488 21.0019L3.00748 7.00368C3.00759 6.45091 3.45752 6.00281 4.0143 6.00281H7.00468V3.00281C7.00468 2.45052 7.4524 2.00281 8.00468 2.00281H20.0047C20.557 2.00281 21.0047 2.45052 21.0047 3.00281V17.0028C21.0047 17.5551 20.557 18.0028 20.0047 18.0028H17.0047ZM7.00468 16.0028V18.0028H9.00468V19.0028H11.0047V18.0028H11.5047C12.8854 18.0028 14.0047 16.8835 14.0047 15.5028C14.0047 14.1221 12.8854 13.0028 11.5047 13.0028H8.50468C8.22854 13.0028 8.00468 12.7789 8.00468 12.5028C8.00468 12.2267 8.22854 12.0028 8.50468 12.0028H13.0047V10.0028H11.0047V9.00281H9.00468V10.0028H8.50468C7.12397 10.0028 6.00468 11.1221 6.00468 12.5028C6.00468 13.8835 7.12397 15.0028 8.50468 15.0028H11.5047C11.7808 15.0028 12.0047 15.2267 12.0047 15.5028C12.0047 15.7789 11.7808 16.0028 11.5047 16.0028H7.00468Z"></path></svg>
      Add Product
    </button>

    <button id="value8" onclick="viewPro()">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C10.298 22 8.69525 21.5748 7.29229 20.8248L2 22L3.17629 16.7097C2.42562 15.3063 2 13.7028 2 12C2 6.47715 6.47715 2 12 2ZM13 7H11V14H17V12H13V7Z"></path></svg>
      View Product
    </button>
    <button id="value8" onclick="listPro()">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 10C14.2091 10 16 8.20914 16 6 16 3.79086 14.2091 2 12 2 9.79086 2 8 3.79086 8 6 8 8.20914 9.79086 10 12 10ZM5.5 13C6.88071 13 8 11.8807 8 10.5 8 9.11929 6.88071 8 5.5 8 4.11929 8 3 9.11929 3 10.5 3 11.8807 4.11929 13 5.5 13ZM21 10.5C21 11.8807 19.8807 13 18.5 13 17.1193 13 16 11.8807 16 10.5 16 9.11929 17.1193 8 18.5 8 19.8807 8 21 9.11929 21 10.5ZM12 11C14.7614 11 17 13.2386 17 16V22H7V16C7 13.2386 9.23858 11 12 11ZM5 15.9999C5 15.307 5.10067 14.6376 5.28818 14.0056L5.11864 14.0204C3.36503 14.2104 2 15.6958 2 17.4999V21.9999H5V15.9999ZM22 21.9999V17.4999C22 15.6378 20.5459 14.1153 18.7118 14.0056 18.8993 14.6376 19 15.307 19 15.9999V21.9999H22Z"></path></svg>
      Product List
    </button>
  
    <button id="value8" onclick="listSett()">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 10C14.2091 10 16 8.20914 16 6 16 3.79086 14.2091 2 12 2 9.79086 2 8 3.79086 8 6 8 8.20914 9.79086 10 12 10ZM5.5 13C6.88071 13 8 11.8807 8 10.5 8 9.11929 6.88071 8 5.5 8 4.11929 8 3 9.11929 3 10.5 3 11.8807 4.11929 13 5.5 13ZM21 10.5C21 11.8807 19.8807 13 18.5 13 17.1193 13 16 11.8807 16 10.5 16 9.11929 17.1193 8 18.5 8 19.8807 8 21 9.11929 21 10.5ZM12 11C14.7614 11 17 13.2386 17 16V22H7V16C7 13.2386 9.23858 11 12 11ZM5 15.9999C5 15.307 5.10067 14.6376 5.28818 14.0056L5.11864 14.0204C3.36503 14.2104 2 15.6958 2 17.4999V21.9999H5V15.9999ZM22 21.9999V17.4999C22 15.6378 20.5459 14.1153 18.7118 14.0056 18.8993 14.6376 19 15.307 19 15.9999V21.9999H22Z"></path></svg>
      Setting
    </button>
   
  </div>


     <a href="home.html"><Button style="background: white; width: 80%; background: red; margin-top: 35%; height: 6vh; border: none; color: white; border-radius: 5px; cursor: pointer; margin-left: 5%;">Logout</Button></a>

            </div>


        </aside>





        <section id="flip-box">

          <div class="flip-card">
    <div class="flip-card-inner">
        <div class="flip-card-front">
            <p class="title">WELCOME TO</p>
            <p style="font-size: 30px; font-weight: bolder;">VENDOR PAGE</p>
        </div>
        <div class="flip-card-back">
            <p class="title">VENDOR</p>
            <p style="font-size: 20px;">We welcome you to our marketplace! We're excited to have you on board. <br> Let's grow your business together with our platform and dedicated support team.</p>
        </div>
    </div>
   </div>

        </section>






        <div class="vendor-top">

        
        <?php
// Database connection
$conn = new mysqli("localhost", "root", "", "market");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$totalProducts = 0;

// Check if vendor is logged in and session contains vendor_id
if (isset($_SESSION['vendor_id'])) {
    $vendor_id = $_SESSION['vendor_id'];

    // Query to get total number of products posted by the specific vendor
    $stmt = $conn->prepare("SELECT COUNT(*) AS total_products FROM products WHERE vendor_id = ?");
    $stmt->bind_param("i", $vendor_id); // Bind vendor_id as an integer
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $totalProducts = $row['total_products']; // Total products posted by the vendor
    }

    $stmt->close();
}

$conn->close();
?>

<div class="cardse">
  <div class="carde rede">
      <p class="tipe">Total Product Posted</p>
      <p class="second-texte"><?php echo $totalProducts; ?></p>
  </div>
  
</div>


        </div>



        <div id="cover-product">
          <h1 ondblclick="exitCover()">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20ZM12 10.5858L14.8284 7.75736L16.2426 9.17157L13.4142 12L16.2426 14.8284L14.8284 16.2426L12 13.4142L9.17157 16.2426L7.75736 14.8284L10.5858 12L7.75736 9.17157L9.17157 7.75736L12 10.5858Z"></path></svg>
          </h1>

          <form action="upload_product.php" method="POST" enctype="multipart/form-data" id="cover-center">
  <div class="form-container9">
    
    <div class="form-group9">
      <label for="product_name">Product Name</label>
      <input required name="product_name" id="product_name" type="text">
    </div>

    <div class="form-group9">
      <label for="description">Description</label>
      <textarea required cols="50" rows="10" id="description" name="description"></textarea>
    </div>

    <div class="form-group9">
      <label for="price">Product Price</label>
      <input required name="price" id="price" type="text">
    </div>

    <div class="form-group9">
      <label for="vendor">Vendor Name</label>
      <input type="text" name="vendor_name" required>
    </div>

    <div class="form-group9">
      <label for="telephone">Telephone Number</label>
      <input type="tel" name="telephone" id="telephone" required>
    </div>

    <div class="form-group9">
      <label for="location">Location (Region)</label>
      <select name="location" id="location" required>
        <option value="">-- Select Region --</option>
        <option value="Ahafo">Ahafo</option>
        <option value="Ashanti">Ashanti</option>
        <option value="Bono">Bono</option>
        <option value="Bono East">Bono East</option>
        <option value="Central">Central</option>
        <option value="Eastern">Eastern</option>
        <option value="Greater Accra">Greater Accra</option>
        <option value="North East">North East</option>
        <option value="Northern">Northern</option>
        <option value="Oti">Oti</option>
        <option value="Savannah">Savannah</option>
        <option value="Upper East">Upper East</option>
        <option value="Upper West">Upper West</option>
        <option value="Volta">Volta</option>
        <option value="Western">Western</option>
        <option value="Western North">Western North</option>
      </select>
    </div>

    <div class="form-group9">
      <label for="product_image">Product Image</label>
      <input required name="product_image" id="product_image" type="file">
    </div>

    <button type="submit" class="form-submit-btn9">Upload</button>
  </div>
</form>

        </div>

      

    </main>
    
    <script src="code.js"></script>
</body>
</html>