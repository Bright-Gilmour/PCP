<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "market";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all users
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Users Table</title>
  <link rel="stylesheet" href="vendor.css">
</head>
<body>

<main class="customer-page">
  <div class="container3">
    <h2>Welcome to Customer Table</h2>
    <ul class="responsive-table">
      <li class="table-header">
        <div class="col col-1">ID</div>
        <div class="col col-2">First Name</div>
        <div class="col col-3">Last Name</div>
        <div class="col col-4">Email</div>
        <div class="col col-4">Password</div>
        <div class="col col-4">Edit</div>
        <div class="col col-4">Delete</div>
      </li>

      <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
          <li class="table-row">
            <div class="col col-1" data-label="ID"><?= htmlspecialchars($row['id']) ?></div>
            <div class="col col-2" data-label="First Name"><?= htmlspecialchars($row['firstname']) ?></div>
            <div class="col col-3" data-label="Last Name"><?= htmlspecialchars($row['lastname']) ?></div>
            <div class="col col-4" data-label="Email"><?= htmlspecialchars($row['email']) ?></div>
            <div class="col col-4" data-label="Password"><?= htmlspecialchars($row['password']) ?></div>
            
            <div class="col col-4" data-label="Edit">
            <a href="edit_user.php?id=<?= $row['id'] ?>"><button style="background: blue; border: none; height: 4vh; width: 50%; cursor: pointer; color: white; border-radius: 5px;">Edit</button></a>
            </div>

            <div class="col col-4" data-label="Delete">
              <a href="delete_user.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this user?');">
                <button style="background: rgb(255, 0, 0); border: none; height: 4vh; width: 50%; cursor: pointer; color: white; border-radius: 5px;">Delete</button>
              </a>
            </div>

          </li>
        <?php endwhile; ?>
      <?php else: ?>
        <li class="table-row">
          <div class="col col-1" colspan="7">No users found.</div>
        </li>
      <?php endif; ?>

    </ul>
  </div>
</main>

</body>
</html>

<?php $conn->close(); ?>
