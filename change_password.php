<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Include database connection file
require_once "db_connection.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve current password, new password, and confirm password from the form
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate the current password (You can add your own validation logic here)
    // For demonstration, let's assume the current password is stored securely in the database

    // Check if new password and confirm password match
    if ($new_password === $confirm_password) {
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update the password in the database (You should replace 'users' with your actual table name)
        $query = "UPDATE users SET password = ? WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $hashed_password, $_SESSION['username']);
        $stmt->execute();

        // Redirect to a success page or display a success message
        header("Location: change_password_success.php");
        exit;
    } else {
        // Passwords do not match, show error message
        $error = "New password and confirm password do not match.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>change password</title>
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
    margin: auto;
    padding: 4rem;
    background-color: #333;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    border-radius: 5px;
}

h2 {
    text-align: center;
    margin-bottom: 3rem;
    color: #fff;
}

form {
    display: flex;
    flex-direction: column;
    align-items: center;
}

label {
    display: block;
    margin-bottom: 8px;
    color: #fff;
}

input[type="password"],
input[type="submit"] {
    width: 80%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
    box-sizing: border-box;
}

input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    cursor: pointer;
}

.error {
    color: #ff0000;
    margin-bottom: 10px;
    text-align: center;
}

.footer {
    margin-top: 1rem;
    text-align: center;
    color: #999;
    font-size: 12px;
}

    </style>
</head>
<body>
<div class="container">
    <h2>Change Password</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="current_password">Current Password:</label>
        <input type="password" id="current_password" name="current_password" required>

        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" required>

        <label for="confirm_password">Confirm New Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>

        <input type="submit" value="Change Password">
    </form>
    <?php if (isset($error)) { echo '<div class="error">' . $error . '</div>'; } ?>
</div>

</body>
</html>