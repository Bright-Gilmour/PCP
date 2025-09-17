<?php
$conn = new mysqli("localhost", "root", "", "market");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Fetch user
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
}

// Update user
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST["firstname"];
    $lname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"]; // password as plain text

    $sql = "UPDATE users SET firstname=?, lastname=?, email=?, password=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $fname, $lname, $email, $password, $id);
    if ($stmt->execute()) {
        header("Location: customer.php");
        exit();
    } else {
        echo "Update failed!";
    }
}
?>

<style>

form{
    background: rgb(255, 255, 255);
    width: 40%;
    height: 70vh;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    border-radius: 10px;
    box-shadow: 1px 1px 10px 1px rgba(146, 146, 146, 0.63);


           /* PHONE SCREEN */
    @media (max-width: 767px) {
        width: 80%;
    
	}
}

form h2{
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin-left: 2%;
    text-align: center;
}

form input{
    width: 90%;
    height: 6vh;
    margin: 1%;
    margin-top: 5%;
    border-radius: 5px;
    background: transparent;
    margin-left: 5%;
    outline: none;
    border: 1px solid rgb(17, 16, 32);
}


form input:hover{
    box-shadow: 1px 1px 10px 1px rgba(146, 146, 146, 0.63);
    border: blue;
}

form button{
    margin-top: 5%;
    margin-left: 25%;
    height: 6vh;
    width: 50%;
    border-radius: 5px;
    border: none;
    cursor: pointer;
    background: rgb(17, 16, 32);
    color: aliceblue;
    font-size: 18px;
}


form button:hover{
    background: transparent;
    border: 2px solid rgb(17, 16, 32);
    color: black;
    box-shadow: 1px 1px 10px 1px rgba(109, 107, 107, 0.63);
}

</style>

<form method="POST">
    <h2>User Update</h2>
    <hr>
  <input type="text" name="firstname" value="<?= htmlspecialchars($user['firstname']) ?>" required><br>
  <input type="text" name="lastname" value="<?= htmlspecialchars($user['lastname']) ?>" required><br>
  <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required><br>
  <input type="text" name="password" value="<?= htmlspecialchars($user['password']) ?>" required><br>
  <button type="submit">Update</button>
</form>
