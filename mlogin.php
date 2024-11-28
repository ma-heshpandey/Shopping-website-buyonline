<?php
// Name: Mahesh Pandey Id: 105108938
?>

<?php
// Start session
session_start();

// Get manager credentials from the login form
$managerId = isset($_POST['managerId']) ? trim($_POST['managerId']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

$filename = '../../data/manager.txt'; // Path to the manager.txt file
$loggedIn = false;

if ($managerId === '' || $password === '') {
    echo "Both Manager ID and Password are required!";
    exit;
}

// Check if the manager.txt file exists
if (file_exists($filename)) {
    $file = fopen($filename, "r");
    while (($line = fgets($file)) !== false) {
        list($id, $pwd) = explode(',', trim($line));

        // Check if the manager ID and password match
        if ($id === $managerId && $pwd === $password) {
            $_SESSION['managerId'] = $managerId; // Set session variable for manager
            $loggedIn = true;
            break;
        }
    }
    fclose($file);
} else {
    echo "Manager data file not found!";
    exit;
}

// If login is successful, redirect to the correct PHP file
if ($loggedIn) {
    header("Location: manager_menu.php"); // Redirect to the PHP version of the manager menu
    exit;
} else {
    echo "Invalid Manager ID or Password! Back to manager login: <a href='mlogin.htm'>Manager Login</a>";
}
?>
