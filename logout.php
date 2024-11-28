<?php
// Name: Mahesh Pandey Id: 105108938
?>

<?php

session_start();

// Check if it's a manager or a customer logging out
if (isset($_SESSION['managerId'])) {
    $managerId = $_SESSION['managerId'];

    // Destroy the session to log out the manager
    session_destroy();

    // Redirect to logout.htm with the managerId in the query string
    header("Location: logout.htm?managerId=" . urlencode($managerId));
    exit;
} elseif (isset($_SESSION['customerId'])) {
    $customerId = $_SESSION['customerId'];

    // Destroy the session to log out the customer
    session_destroy();

    // Redirect to logout.htm with the customerId in the query string
    header("Location: logout.htm?customerId=" . urlencode($customerId));
    exit;
} else {
    // If no session exists, redirect to the appropriate login page
    header("Location: mlogin.htm"); // You can also direct customers to a customer login page if needed
    exit;
}
?>
