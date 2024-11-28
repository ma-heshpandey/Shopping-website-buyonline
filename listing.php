<?php
// Name: Mahesh Pandey Id: 105108938
?>

<?php

// Retrieve POST data
$name = isset($_POST['name']) ? $_POST['name'] : '';
$price = isset($_POST['price']) ? $_POST['price'] : '';
$quantity = isset($_POST['quantity']) ? $_POST['quantity'] : '';
$description = isset($_POST['description']) ? $_POST['description'] : '';

if ($name == '' || $price == '' || $quantity == '' || $description == '') {
    echo "All fields are required!";
    exit;
}

$xmlFile = '../../data/goods.xml';
$dom = new DOMDocument('1.0', 'UTF-8');

// Check if the XML file exists
if (file_exists($xmlFile)) {
    $dom->load($xmlFile);
} else {
    // Create the root element if the file doesn't exist
    $root = $dom->createElement('goods');
    $dom->appendChild($root);
}

// Generate a new item number
$itemNumber = uniqid('item_', true);

// Create a new item element
$newItem = $dom->createElement('item');
$newItem->appendChild($dom->createElement('id', $itemNumber));
$newItem->appendChild($dom->createElement('name', $name));
$newItem->appendChild($dom->createElement('price', $price));
$newItem->appendChild($dom->createElement('quantityAvailable', $quantity));
$newItem->appendChild($dom->createElement('quantityOnHold', 0)); // Initialize quantity on hold as 0
$newItem->appendChild($dom->createElement('quantitySold', 0)); // Initialize quantity sold as 0
$newItem->appendChild($dom->createElement('description', $description));

// Append the new item to the root element
$dom->documentElement->appendChild($newItem);

// Save the updated XML file
$dom->save($xmlFile);

// Return the item number to the client
echo json_encode(['success' => true, 'itemNumber' => $itemNumber]);
?>
