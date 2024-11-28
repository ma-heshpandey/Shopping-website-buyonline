<!-- Name: Mahesh Pandey Id: 105108938 -->

<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Load the XML file
    $xmlFile = '../../data/customer.xml';
    $dom = new DOMDocument();
    $dom->load($xmlFile);

    // Fetch all customer entries from the XML
    $customers = $dom->getElementsByTagName('customer');
    $loggedIn = false;

    foreach ($customers as $customer) {
        $storedEmail = $customer->getElementsByTagName('email')->item(0)->nodeValue;
        $storedPassword = $customer->getElementsByTagName('password')->item(0)->nodeValue;

        // Check if the provided email and password match
        if ($storedEmail === $email && $storedPassword === $password) {
            $_SESSION['customerId'] = $customer->getElementsByTagName('id')->item(0)->nodeValue; // Save customer ID to session
            $loggedIn = true;
            break;
        }
    }

    // Redirect to buying page if login is successful
    if ($loggedIn) {
        header("Location: buying.htm");
        exit;
    } else {
        echo "Invalid email or password!Go back to Main page <a href='buyonline.htm'>BuyOnline</a>";
    }
} else {
    echo "Invalid request method!";
}
?>
