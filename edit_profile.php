<?php
session_start();

// Include your database connection file
include_once "db_connection.php";

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit;
}

// Fetch the user's current information from the database
$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve updated profile information from the form
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Update the user's information in the database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password
    $update_sql = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', email = '$email', password = '$hashed_password' WHERE username = '$username'";
    if (mysqli_query($conn, $update_sql)) {
        // Update successful, redirect to profile page or home page
        header("Location: profile.php");
        exit;
    } else {
        $error = "Error updating profile: " . mysqli_error($conn);
    }
}

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #1f1f1f;
    color: #fff;
}

.container {
    max-width: 500px;
    margin: 20px auto;
    padding: 20px;
    background-color: #333;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    border-radius: 5px;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 8px;
}

input[type="text"],
input[type="email"],
input[type="password"],
input[type="submit"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

.error {
    color: #ff0000;
    margin-bottom: 10px;
}

    </style>
</head>
<body>
<div class="container">
    <h2>Edit Profile</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" value="<?php echo $row['first_name']; ?>" required>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" value="<?php echo $row['last_name']; ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required>

        <label for="password">New Password:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Update Profile">
    </form>
    <?php if (isset($error)) { echo '<div class="error">' . $error . '</div>'; } ?>
</div>

</body>
</html>
