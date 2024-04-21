<?php
session_start();

// Include your database connection file
include_once "db_connection.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare a SQL statement to fetch the hashed password for the user
    $sql = "SELECT password FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Fetch the hashed password from the database
        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row['password'];

        // Verify the hashed password using password_verify
        if (password_verify($password, $hashed_password)) {
            // Password is correct, set session variables and redirect to home page
            $_SESSION['username'] = $username;
            header("Location: home.php");
            exit;
        } else {
            // Authentication failed, show error message
            $error = "Invalid username or password.";
        }
    } else {
        // User does not exist, show error message
        $error = "Invalid username or password.";
    }
}

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #1f1f1f;
            color: #fff;
        }
        .screen {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            max-width: 500px;
            margin: auto;
            padding: 4rem;
            background-color: #333;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            border-radius: 5px;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h2 {
            text-align: center;
            margin-bottom: 3rem;
        }
        input[type="text"],
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
            margin-top: 20px;
        }
        .error {
            color: #ff0000;
            margin-bottom: 10px;
        }
        .info {
            margin-top: 1rem;
            text-align: center;
            color: #999;
        }
        .footer {
            margin-top: 1rem;
            text-align: center;
            color: #999;
            font-size: 12px;
        }
        .info a {
            color: #4CAF50;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="screen">
        <div class="container">
            <h2>Login to Your Account</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" value="Login">
                <?php if (isset($error)) { echo '<div class="error">' . $error . '</div>'; } ?>
            </form>
            <div class="info">
                <a href="forgot_password.php" style="color: #4CAF50; text-decoration: none;">Forgot password?</a>
            </div>
            <div class="info">
                Don't have an account? <a href="signup.php" style="color: #4CAF50; text-decoration: none;">Sign up here</a>.
            </div>
            <div class="footer">
                &copy; 2024 IT Consultancy Services. All rights reserved.
            </div>
        </div>
    </div>
</body>
</html>
