<?php

// Name: Mahesh Pandey Id: 105108938


// Retrieve POST data
$fname = isset($_POST['fname']) ? $_POST['fname'] : '';
$lname = isset($_POST['lname']) ? $_POST['lname'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';

if ($fname == '' || $lname == '' || $email == '' || $password == '') {
    echo "All fields except phone are required!";
    exit;
}

$xmlFile = '../../data/customer.xml';
$dom = new DOMDocument('1.0', 'UTF-8');

// Check if the XML file exists
if (file_exists($xmlFile)) {
    $dom->load($xmlFile);
} else {
    $root = $dom->createElement('customers');
    $dom->appendChild($root);
}

// Check for unique email
$customers = $dom->getElementsByTagName('customer');
foreach ($customers as $customer) {
    if ($customer->getElementsByTagName('email')->item(0)->nodeValue === $email) {
        echo "Email already registered!";
        exit;
    }
}

// Create a new customer element
$newCustomer = $dom->createElement('customer');
$customerId = uniqid('uid_', true); // Generate the unique customer ID
$id = $dom->createElement('id', $customerId);
$newCustomer->appendChild($id);
$newCustomer->appendChild($dom->createElement('fname', $fname));
$newCustomer->appendChild($dom->createElement('lname', $lname));
$newCustomer->appendChild($dom->createElement('email', $email));
$newCustomer->appendChild($dom->createElement('password', $password));
$newCustomer->appendChild($dom->createElement('phone', $phone));

// Append the new customer to the root element
$dom->documentElement->appendChild($newCustomer);

// Save the updated XML file
$dom->save($xmlFile);

// Return the customer ID to the front-end
echo "Registration successful! Your Customer ID is: " . $customerId;
?>
