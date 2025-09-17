<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "market");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all vendors
$sql = "SELECT * FROM vendors";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Vendors Table</title>
  <link rel="stylesheet" href="vendor.css">
</head>
<body>

<main class="customer-page">
  <div class="container3">
    <h2>Welcome to Vendor Table</h2>
    <ul class="responsive-table">
      <li class="table-header">
        <div class="col col-1">ID</div>
        <div class="col col-3">Vendor Name</div>
        <div class="col col-4">Email</div>
        <div class="col col-4">Password</div>
        <div class="col col-4">Edit</div>
        <div class="col col-4">Delete</div>
      </li>

      <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
          <li class="table-row">
            <div class="col col-1" data-label="ID"><?= htmlspecialchars($row['vendor_id']) ?></div>
            <div class="col col-3" data-label="Vendor Name"><?= htmlspecialchars($row['vendor_name']) ?></div>
            <div class="col col-4" data-label="Email"><?= htmlspecialchars($row['email']) ?></div>
            <div class="col col-4" data-label="Password"><?= htmlspecialchars($row['password']) ?></div>

            <div class="col col-4" data-label="Edit">
              <a href="edit_vendor.php?vendor_id=<?= $row['vendor_id'] ?>"><button style="background: blue; border: none; height: 4vh; width: 50%; cursor: pointer; color: white; border-radius: 5px;">Edit</button></a>
            </div>

            <div class="col col-4" data-label="Delete">
              <a href="delete_vendor.php?vendor_id=<?= $row['vendor_id'] ?>" onclick="return confirm('Are you sure you want to delete this vendor?');">
                <button style="background: rgb(255, 0, 0); border: none; height: 4vh; width: 50%; cursor: pointer; color: white; border-radius: 5px;">Delete</button>
              </a>
            </div>
          </li>
        <?php endwhile; ?>
      <?php else: ?>
        <li class="table-row">
          <div class="col col-1" colspan="6">No vendors found.</div>
        </li>
      <?php endif; ?>
    </ul>
  </div>
</main>

</body>
</html>

<?php $conn->close(); ?>
