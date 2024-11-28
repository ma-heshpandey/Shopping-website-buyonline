<?php
// Name: Mahesh Pandey Id: 105108938
?>

<?php
session_start();

// Check if the customer is logged in
if (!isset($_SESSION['customerId'])) {
    // If not logged in, return a response indicating that
    echo json_encode(['loggedIn' => false]);
} else {
    // If logged in, return a response indicating success
    echo json_encode(['loggedIn' => true]);
}
?>
