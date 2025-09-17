
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin.css">

     <style>
        .passport {
            width: 20%;
            height: 10vh;
            object-fit: cover;
            border: 1px solid #ccc;
            border-radius: 4px;
            position: relative;
            margin-top: 35%;
            margin-left: 25%;
        }
    </style>

</head>
<body>

    <main class="admin-dashb">


        <aside class="left-box3">
            <h3>ADMIN PAGE</h3>
            
            <?php
// Assuming session_start() is already called
$conn = new mysqli("localhost", "root", "", "market");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$profilePic = 'pic/user.png'; // Default image
$adminName = 'Guest';

if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];

    // Adjust table and column names to match your database
    $stmt = $conn->prepare("SELECT profile_picture, name FROM admin WHERE id = ?");
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (!empty($row['profile_picture']) && file_exists("uploads/" . $row['profile_picture'])) {
            $profilePic = "uploads/" . $row['profile_picture'];
        }
        $adminName = htmlspecialchars($row['name']);
    }

    $stmt->close();
}

$conn->close();
?>

<div style="margin-top: 21%; margin-left: 10%;" id="picture-form">
  <img src="<?php echo $profilePic; ?>" alt="Profile Picture" style="width:100px; height:100px; object-fit:cover; border-radius:50%; margin-bottom: -20px;">
  <br>
  <h5 style="margin-top: 18%; margin-left: 0%; color: #ffffff;  font-weight: bolder;  font-size: 14px;">Name: <?php echo $adminName; ?></h5>
</div>

  
  
            
  
              <div class="box-inside3">
  
               
                
  <div class="input9">
    
      <button id="value9">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M3 12C3 12.5523 3.44772 13 4 13H10C10.5523 13 11 12.5523 11 12V4C11 3.44772 10.5523 3 10 3H4C3.44772 3 3 3.44772 3 4V12ZM3 20C3 20.5523 3.44772 21 4 21H10C10.5523 21 11 20.5523 11 20V16C11 15.4477 10.5523 15 10 15H4C3.44772 15 3 15.4477 3 16V20ZM13 20C13 20.5523 13.4477 21 14 21H20C20.5523 21 21 20.5523 21 20V12C21 11.4477 20.5523 11 20 11H14C13.4477 11 13 11.4477 13 12V20ZM14 3C13.4477 3 13 3.44772 13 4V8C13 8.55228 13.4477 9 14 9H20C20.5523 9 21 8.55228 21 8V4C21 3.44772 20.5523 3 20 3H14Z"></path></svg>
        Dashboard
      </button>
      <a href="customer.php">
      <button id="value9">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M17.0047 16.0028H19.0047V4.00281H9.00468V6.00281H17.0047V16.0028ZM17.0047 18.0028V21.0019C17.0047 21.5547 16.5547 22.0028 15.9978 22.0028H4.01154C3.45548 22.0028 3.00488 21.5582 3.00488 21.0019L3.00748 7.00368C3.00759 6.45091 3.45752 6.00281 4.0143 6.00281H7.00468V3.00281C7.00468 2.45052 7.4524 2.00281 8.00468 2.00281H20.0047C20.557 2.00281 21.0047 2.45052 21.0047 3.00281V17.0028C21.0047 17.5551 20.557 18.0028 20.0047 18.0028H17.0047ZM7.00468 16.0028V18.0028H9.00468V19.0028H11.0047V18.0028H11.5047C12.8854 18.0028 14.0047 16.8835 14.0047 15.5028C14.0047 14.1221 12.8854 13.0028 11.5047 13.0028H8.50468C8.22854 13.0028 8.00468 12.7789 8.00468 12.5028C8.00468 12.2267 8.22854 12.0028 8.50468 12.0028H13.0047V10.0028H11.0047V9.00281H9.00468V10.0028H8.50468C7.12397 10.0028 6.00468 11.1221 6.00468 12.5028C6.00468 13.8835 7.12397 15.0028 8.50468 15.0028H11.5047C11.7808 15.0028 12.0047 15.2267 12.0047 15.5028C12.0047 15.7789 11.7808 16.0028 11.5047 16.0028H7.00468Z"></path></svg>
        Customer
      </button>
    </a>

    <a href="vendors-list.php">
      <button id="value9">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C10.298 22 8.69525 21.5748 7.29229 20.8248L2 22L3.17629 16.7097C2.42562 15.3063 2 13.7028 2 12C2 6.47715 6.47715 2 12 2ZM13 7H11V14H17V12H13V7Z"></path></svg>
        Vendors
      </button>
    </a>
      
    <a href="product.php">
      <button id="value9">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 10C14.2091 10 16 8.20914 16 6 16 3.79086 14.2091 2 12 2 9.79086 2 8 3.79086 8 6 8 8.20914 9.79086 10 12 10ZM5.5 13C6.88071 13 8 11.8807 8 10.5 8 9.11929 6.88071 8 5.5 8 4.11929 8 3 9.11929 3 10.5 3 11.8807 4.11929 13 5.5 13ZM21 10.5C21 11.8807 19.8807 13 18.5 13 17.1193 13 16 11.8807 16 10.5 16 9.11929 17.1193 8 18.5 8 19.8807 8 21 9.11929 21 10.5ZM12 11C14.7614 11 17 13.2386 17 16V22H7V16C7 13.2386 9.23858 11 12 11ZM5 15.9999C5 15.307 5.10067 14.6376 5.28818 14.0056L5.11864 14.0204C3.36503 14.2104 2 15.6958 2 17.4999V21.9999H5V15.9999ZM22 21.9999V17.4999C22 15.6378 20.5459 14.1153 18.7118 14.0056 18.8993 14.6376 19 15.307 19 15.9999V21.9999H22Z"></path></svg>
      Products
      </button>
    </a>

    <a href="admin-settings.php">
      <button id="value9">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M2 18H9V20H2V18ZM2 11H11V13H2V11ZM2 4H22V6H2V4ZM20.674 13.0251L21.8301 12.634L22.8301 14.366L21.914 15.1711C21.9704 15.4386 22 15.7158 22 16C22 16.2842 21.9704 16.5614 21.914 16.8289L22.8301 17.634L21.8301 19.366L20.674 18.9749C20.2635 19.3441 19.7763 19.6295 19.2391 19.8044L19 21H17L16.7609 19.8044C16.2237 19.6295 15.7365 19.3441 15.326 18.9749L14.1699 19.366L13.1699 17.634L14.086 16.8289C14.0296 16.5614 14 16.2842 14 16C14 15.7158 14.0296 15.4386 14.086 15.1711L13.1699 14.366L14.1699 12.634L15.326 13.0251C15.7365 12.6559 16.2237 12.3705 16.7609 12.1956L17 11H19L19.2391 12.1956C19.7763 12.3705 20.2635 12.6559 20.674 13.0251ZM18 18C19.1046 18 20 17.1046 20 16C20 14.8954 19.1046 14 18 14C16.8954 14 16 14.8954 16 16C16 17.1046 16.8954 18 18 18Z"></path></svg>
        Settings
      </button>
    </a>
    </div>



             <a href="home.html"><Button style="background: white; width: 78%; background: red; margin-top: 20%; height: 5vh; border: none; color: white; border-radius: 5px; cursor: pointer; margin-left: 5%;">Logout</Button></a>
          
              </div>
  
  
          </aside>







          <?php
// Database connection
$conn = new mysqli("localhost", "root", "", "market");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Count products
$product_result = $conn->query("SELECT COUNT(*) AS total_products FROM products");
$product_count = $product_result->fetch_assoc()['total_products'];

// Count vendors
$vendor_result = $conn->query("SELECT COUNT(*) AS total_vendors FROM vendors");
$vendor_count = $vendor_result->fetch_assoc()['total_vendors'];

// Count users
$user_result = $conn->query("SELECT COUNT(*) AS total_users FROM users");
$user_count = $user_result->fetch_assoc()['total_users'];

$conn->close();
?>

<div class="vendor-top2">
  <div class="cardse2">
    <div class="carde2 rede2">
      <svg style="width: 40%; margin-top: -6%;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12.001 22C6.47813 22 2.00098 17.5228 2.00098 12C2.00098 6.47715 6.47813 2 12.001 2C17.5238 2 22.001 6.47715 22.001 12C22.001 17.5228 17.5238 22 12.001 22ZM12.001 20C16.4193 20 20.001 16.4183 20.001 12C20.001 7.58172 16.4193 4 12.001 4C7.5827 4 4.00098 7.58172 4.00098 12C4.00098 16.4183 7.5827 20 12.001 20ZM13.3345 12C14.1629 12 14.8345 11.3284 14.8345 10.5C14.8345 9.67157 14.1629 9 13.3345 9H10.501V12H13.3345ZM13.3345 7C15.2675 7 16.8345 8.567 16.8345 10.5C16.8345 12.433 15.2675 14 13.3345 14H10.501V17H8.50098V7H13.3345Z"></path></svg>
      
      <p class="tipe2">Total Number of Products</p>
      <p style=" color: #ffffff;  font-weight: bolder;  font-size: 47px;" class="second-texte2"><?= $product_count ?></p>
    </div>

    <div class="carde2 bluee2">
      <svg style="width: 40%; margin-top: -6%;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 11C14.7614 11 17 13.2386 17 16V22H15V16C15 14.4023 13.7511 13.0963 12.1763 13.0051L12 13C10.4023 13 9.09634 14.2489 9.00509 15.8237L9 16V22H7V16C7 13.2386 9.23858 11 12 11ZM5.5 14C5.77885 14 6.05009 14.0326 6.3101 14.0942C6.14202 14.594 6.03873 15.122 6.00896 15.6693L6 16L6.0007 16.0856C5.88757 16.0456 5.76821 16.0187 5.64446 16.0069L5.5 16C4.7203 16 4.07955 16.5949 4.00687 17.3555L4 17.5V22H2V17.5C2 15.567 3.567 14 5.5 14ZM18.5 14C20.433 14 22 15.567 22 17.5V22H20V17.5C20 16.7203 19.4051 16.0796 18.6445 16.0069L18.5 16C18.3248 16 18.1566 16.03 18.0003 16.0852L18 16C18 15.3343 17.8916 14.694 17.6915 14.0956C17.9499 14.0326 18.2211 14 18.5 14ZM5.5 8C6.88071 8 8 9.11929 8 10.5C8 11.8807 6.88071 13 5.5 13C4.11929 13 3 11.8807 3 10.5C3 9.11929 4.11929 8 5.5 8ZM18.5 8C19.8807 8 21 9.11929 21 10.5C21 11.8807 19.8807 13 18.5 13C17.1193 13 16 11.8807 16 10.5C16 9.11929 17.1193 8 18.5 8ZM5.5 10C5.22386 10 5 10.2239 5 10.5C5 10.7761 5.22386 11 5.5 11C5.77614 11 6 10.7761 6 10.5C6 10.2239 5.77614 10 5.5 10ZM18.5 10C18.2239 10 18 10.2239 18 10.5C18 10.7761 18.2239 11 18.5 11C18.7761 11 19 10.7761 19 10.5C19 10.2239 18.7761 10 18.5 10ZM12 2C14.2091 2 16 3.79086 16 6C16 8.20914 14.2091 10 12 10C9.79086 10 8 8.20914 8 6C8 3.79086 9.79086 2 12 2ZM12 4C10.8954 4 10 4.89543 10 6C10 7.10457 10.8954 8 12 8C13.1046 8 14 7.10457 14 6C14 4.89543 13.1046 4 12 4Z"></path></svg>

      <p class="tipe2">Total Number of Vendors</p>
      <p style=" color: #ffffff;  font-weight: bolder;  font-size: 47px;" class="second-texte2"><?= $vendor_count ?></p>
    </div>

    <div class="carde2 greene2">
      <svg style="width: 40%; margin-top: -6%;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M2 22C2 17.5817 5.58172 14 10 14C14.4183 14 18 17.5817 18 22H2ZM10 13C6.685 13 4 10.315 4 7C4 3.685 6.685 1 10 1C13.315 1 16 3.685 16 7C16 10.315 13.315 13 10 13ZM17.3628 15.2332C20.4482 16.0217 22.7679 18.7235 22.9836 22H20C20 19.3902 19.0002 17.0139 17.3628 15.2332ZM15.3401 12.9569C16.9728 11.4922 18 9.36607 18 7C18 5.58266 17.6314 4.25141 16.9849 3.09687C19.2753 3.55397 21 5.57465 21 8C21 10.7625 18.7625 13 16 13C15.7763 13 15.556 12.9853 15.3401 12.9569Z"></path></svg>

      <p class="tipe2">Total Number of Users</p>
      <p style=" color: #ffffff;  font-weight: bolder;  font-size: 47px;" class="second-texte2"><?= $user_count ?></p>
    </div>
  </div>
</div>



    <section class="welcome-box">

      <div class="bg"></div>
      <div class="bg bg2"></div>
      <div class="bg bg3"></div>
      <div class="content">
      <h1>WELCOME TO ADMIN DASHBOARD</h1>
      </div>

    </section>




    </main>
    
</body>
</html>