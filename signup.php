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
            <form method="post" action="signup_process.php">
                <div class="input-group">
                    <input type="text" name="first_name" placeholder="First Name" required>
                    <input type="text" name="last_name" placeholder="Last Name" required>
                </div>
                <input type="email" name="email" placeholder="Email Address" required>
                <input type="text" name="username" placeholder="Username" required>
                <div class="input-group">
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                </div>
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
