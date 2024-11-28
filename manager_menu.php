<!-- Name: Mahesh Pandey Id: 105108938 -->

<?php
session_start();

// Check if the session variable 'managerId' is set
if (!isset($_SESSION['managerId'])) {
    header("Location: mlogin.php"); // Redirect to login if not logged in
    exit;
}

// Get manager's ID from the session
$managerName = $_SESSION['managerId'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manager Menu</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .nav {
            text-align: center;
            margin-top: 20px;
        }
        .nav a {
            margin: 0 20px;
            text-decoration: none;
            color: #6A0DAD;
            font-size: 18px;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            text-align: center;
            background-color: white;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h2 {
            color: #333;
        }
        .nav-links {
            margin-top: 30px;
            display: flex;
            justify-content: center;
        }
        .nav-links a {
            font-size: 18px;
            color: #007BFF;
            text-decoration: none;
            margin: 0 15px; /* Space between links */
        }
        .nav-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($managerName); ?>!</h2> <!-- Display the manager's ID -->
        
        <div class="nav-links">
            <a href="listing.htm">Listing</a>
            <a href="processing.htm">Processing</a>
        <!-- <a href="logout.htm">Logout</a> Logout link -->

        </div>
    </div>
</body>
</html>
