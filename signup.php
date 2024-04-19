<?php
session_start();

// Define variables and initialize with empty values
$first_name = $last_name = $email = $username = $password = $confirm_password = "";
$first_name_err = $last_name_err = $email_err = $username_err = $password_err = $confirm_password_err = "";
$captcha_err = "";

// Process form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate first name
    if (empty(trim($_POST["first_name"]))) {
        $first_name_err = "Please enter your first name.";
    } else {
        $first_name = trim($_POST["first_name"]);
    }

    // Validate last name
    if (empty(trim($_POST["last_name"]))) {
        $last_name_err = "Please enter your last name.";
    } else {
        $last_name = trim($_POST["last_name"]);
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email address.";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 8) {
        $password_err = "Password must have at least 8 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Validate CAPTCHA
    if (empty($_POST["captcha"]) || $_POST["captcha"] != $_SESSION["captcha_code"]) {
        $captcha_err = "CAPTCHA verification failed.";
    }

    // Check input errors before inserting into database
    if (empty($first_name_err) && empty($last_name_err) && empty($email_err) && empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($captcha_err)) {
        // Redirect to home page after successful signup
        header("location: home.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
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
        .input-group {
            display: flex;
            justify-content: space-between;
            width: 80%;
            margin-bottom: 10px;
        }
        .input-group input {
            width: 48%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        h2 {
            text-align: center;
            margin-bottom: 3rem;
        }
        input[type="text"],
        input[type="email"],
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
            <h2>Create Your Account</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="input-group">
                    <input type="text" name="first_name" placeholder="First Name" value="<?php echo $first_name; ?>" required>
                    <input type="text" name="last_name" placeholder="Last Name" value="<?php echo $last_name; ?>" required>
                </div>
                <span class="error"><?php echo $first_name_err; ?></span>
                <span class="error"><?php echo $last_name_err; ?></span>
                <input type="email" name="email" placeholder="Email Address" value="<?php echo $email; ?>" required>
                <span class="error"><?php echo $email_err; ?></span>
                <input type="text" name="username" placeholder="Username" value="<?php echo $username; ?>" required>
                <span class="error"><?php echo $username_err; ?></span>
                <div class="input-group">
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                </div>
                <span class="error"><?php echo $password_err; ?></span>
                <span class="error"><?php echo $confirm_password_err; ?></span>
                <div class="captcha">
                    <img src="captcha.php" alt="CAPTCHA">
                    <input type="text" name="captcha" placeholder="Enter CAPTCHA" required>
                </div>
                <span class="error"><?php echo $captcha_err; ?></span>
                <input type="submit" value="Sign Up">
            </form>
            <div class="info">
                Already have an account? <a href="login.php" style="color: #4CAF50; text-decoration: none;">Login here</a>.
            </div>
            <div class="footer">
                &copy; 2024 IT Consultancy Services. All rights reserved.
            </div>
        </div>
    </div>
</body>
</html>
