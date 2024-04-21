<?php
session_start();

// Check if user is logged in, redirect to login page if not
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Get user information from the session
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Welcome</title>
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
        max-width: 1200px;
        margin: 20px auto;
        padding: 20px;
    }
    .section {
        margin-bottom: 30px;
        background-color: #333;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
    }
    .section h2 {
        color: #4CAF50;
        margin-bottom: 10px;
    }
    .section p {
        color: #fff;
        line-height: 1.6;
    }
    .section ul {
        color: #fff;
        list-style-type: disc;
        padding-left: 20px;
    }
</style>
</head>
<body>
    <div class="navbar">
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="services.php">Services</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="customers.php">Customers</a></li>
        </ul>
    </div>

    <div class="container">
        <h1 style="text-align: center;">Welcome, <?php echo $username; ?>!</h1>

        <div class="section">
            <h2>About Us</h2>
            <p>We are a leading IT consultancy firm dedicated to providing innovative solutions for businesses.</p>
        </div>

        <div class="section">
            <h2>Our Mission</h2>
            <p>Our mission is to empower businesses with cutting-edge technology solutions and strategic guidance.</p>
        </div>

        <div class="section">
            <h2>Services</h2>
            <p>Explore our range of services tailored to meet your IT needs:</p>
            <ul>
                <li>Software Development</li>
                <li>IT Infrastructure</li>
                <li>Cloud Services</li>
                <li>Data Analytics</li>
                <li>Cybersecurity</li>
                <li>Consulting</li>
            </ul>
        </div>

        <div class="section">
            <h2>Contact Us</h2>
            <p>Have questions or need assistance? Contact our team for personalized support.</p>
            <p>Email: info@itconsultancyservices.com</p>
            <p>Phone: +1 123-456-7890</p>
            <p>Address: 123 Main Street, City, Country</p>
        </div>
    </div>
</body>
</html>
