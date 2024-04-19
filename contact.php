<?php
session_start();

// Define variables and initialize with empty values
$name = $email = $message = "";
$name_err = $email_err = $message_err = "";

// Process form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter your name.";
    } else {
        $name = trim($_POST["name"]);
    }
    
    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email address.";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format.";
    } else {
        $email = trim($_POST["email"]);
    }
    
    // Validate message
    if (empty(trim($_POST["message"]))) {
        $message_err = "Please enter your message.";
    } else {
        $message = trim($_POST["message"]);
    }
    
    // Check input errors before inserting into database
    if (empty($name_err) && empty($email_err) && empty($message_err)) {
        // Set session variable for successful submission
        $_SESSION["contact_success"] = true;
        
        // Redirect to home page after successful submission
        header("location: home.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>IT Consultancy Services - Contact Us</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #1f1f1f;
            color: #fff;
        }
        .navbar {
        background-color: #333;
        padding: 10px 0;
        text-align: center;
        }
        .navbar ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        .navbar ul li {
            display: inline-block;
            margin-right: 20px;
        }
        .navbar ul li a {
            color: #fff;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .navbar ul li a:hover {
            background-color: #4CAF50;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #333;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
        h1, h2 {
            text-align: center;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        textarea {
            height: 150px;
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
        .alert {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="services.php">Services</a></li>
            <li><a href="contact.php">Contact Us</a></li>
        </ul>
    </div>
    <div class="container">
        <h1>Contact Us</h1>
        <p>If you have any questions or inquiries, please fill out the form below to get in touch with us.</p>
        
        <?php if (isset($_SESSION["contact_success"]) && $_SESSION["contact_success"] === true): ?>
        <div class="alert">
            Thank you for contacting us. We will get back to you soon.
        </div>
        <?php unset($_SESSION["contact_success"]); ?>
        <?php endif; ?>
        
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>" placeholder="Enter your name" required>
            <span class="error"><?php echo $name_err; ?></span>
            
            <label for="email">Your Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>" placeholder="Enter your email address" required>
            <span class="error"><?php echo $email_err; ?></span>
            
            <label for="message">Message:</label>
            <textarea id="message" name="message" placeholder="Enter your message" required><?php echo $message; ?></textarea>
            <span class="error"><?php echo $message_err; ?></span>
            
            <input type="submit" value="Send Message">
        </form>
    </div>
</body>
</html>
