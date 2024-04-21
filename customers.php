<?php
session_start();
// Include your database connection file
include_once "db_connection.php";

// Set the number of records per page
$recordsPerPage = 10;

// Calculate total number of pages
$sqlCount = "SELECT COUNT(*) AS total FROM customers";
$resultCount = mysqli_query($conn, $sqlCount);
$rowCount = mysqli_fetch_assoc($resultCount);
$totalRecords = $rowCount['total'];
$totalPages = ceil($totalRecords / $recordsPerPage);

// Get current page number
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $currentPage = $_GET['page'];
} else {
    $currentPage = 1;
}

// Calculate the starting record for the current page
$startFrom = ($currentPage - 1) * $recordsPerPage;

// Fetch customer data for the current page
$sql = "SELECT * FROM customers LIMIT $startFrom, $recordsPerPage";
$result = mysqli_query($conn, $sql);

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Previous Customers</title>
    <style>
        /* CSS styles */
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
        }
        .customer-list {
            margin-top: 20px;
        }
        .customer {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .customer h3 {
            margin-top: 0;
        }
        .customer p {
            margin: 5px 0;
        }
        .pagination {
            margin-top: 20px;
        }
        .pagination a {
            display: inline-block;
            padding: 5px 10px;
            margin-right: 5px;
            background-color: #f4f4f4;
            color: #333;
            text-decoration: none;
            border-radius: 3px;
        }
        .pagination a.active {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Previous Customers</h1>
        <div class="customer-list">
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <div class="customer">
                    <h3><?php echo $row['name']; ?></h3>
                    <p>Email: <?php echo $row['email']; ?></p>
                    <p>Phone: <?php echo $row['phone']; ?></p>
                    <p>Address: <?php echo $row['address']; ?></p>
                </div>
            <?php endwhile; ?>
        </div>
        <!-- Pagination links -->
        <div class="pagination">
            <?php if ($totalPages > 1) : ?>
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <a href="?page=<?php echo $i; ?>" <?php echo ($i == $currentPage) ? 'class="active"' : ''; ?>><?php echo $i; ?></a>
                <?php endfor; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
