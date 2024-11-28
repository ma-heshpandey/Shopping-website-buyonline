<?php
// Name: Mahesh Pandey Id: 105108938
?>

<?php

session_start();

// Check if the manager is logged in
if (!isset($_SESSION['managerId'])) {
    echo json_encode(['loggedIn' => false]);
} else {
    echo json_encode(['loggedIn' => true]);
}
?>
