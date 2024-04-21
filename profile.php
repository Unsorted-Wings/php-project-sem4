<?php
session_start();
// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
// Include your database connection file
include_once "db_connection.php";

// Fetch user data from the database based on the logged-in user
$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
if (!$result || mysqli_num_rows($result) == 0) {
    // Redirect or handle error if user data not found
    header("Location: error.php");
    exit();
}
$row = mysqli_fetch_assoc($result);
// Close database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #1f1f1f;
    color: #fff;
}

.container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #333;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    border-radius: 5px;
}

h1, h2 {
    text-align: center;
}

.profile-info {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 8px;
    color: #fff;
}

p {
    margin-bottom: 15px;
}

.btn-container {
    display: flex;
    justify-content: space-around;
}

.btn {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    text-decoration: none;
    border-radius: 5px;
}

.btn:hover {
    background-color: #45a049;
}

    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo $row['username']; ?></h1>
        <h2>Your Profile</h2>
        <div class="profile-info">
            <label>First Name:</label>
            <p><?php echo $row['first_name']; ?></p>
            <label>Last Name:</label>
            <p><?php echo $row['last_name']; ?></p>
            <label>Email:</label>
            <p><?php echo $row['email']; ?></p>
            <label>Phone:</label>
            <p><?php echo $row['phone']; ?></p>
            <label>Address:</label>
            <p><?php echo $row['address']; ?></p>
            <label>Role:</label>
            <p><?php echo $row['role']; ?></p>
        </div>
        <div class="btn-container">
            <a href="edit_profile.php" class="btn">Edit Profile</a>
            <a href="change_password.php" class="btn">Change Password</a>
            <a href="orders.php" class="btn">View Orders</a>
            <a href="invoices.php" class="btn">View Invoices</a>
        </div>
    </div>
</body>
</html>
