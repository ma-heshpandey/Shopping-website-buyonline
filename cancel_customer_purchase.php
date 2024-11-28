<?php
// Name: Mahesh Pandey Id: 105108938
?>

<?php

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cart = json_decode($_POST['cart'], true);
    $xmlFile = '../../data/goods.xml';

    if (file_exists($xmlFile)) {
        $dom = new DOMDocument();
        $dom->load($xmlFile);
        $xpath = new DOMXPath($dom);

        foreach ($cart as $cartItem) {
            $itemId = $cartItem['id'];
            $quantity = $cartItem['quantity'];

            // Find the item in the XML
            $itemNode = $xpath->query("//item[id='$itemId']")->item(0);
            if ($itemNode) {
                // Update the quantity on hold and quantity available
                $quantityOnHold = $itemNode->getElementsByTagName('quantityOnHold')->item(0);
                $quantityAvailable = $itemNode->getElementsByTagName('quantityAvailable')->item(0);
                $quantityOnHold->nodeValue -= $quantity;
                $quantityAvailable->nodeValue += $quantity;
            }
        }

        // Save the changes to the XML
        $dom->save($xmlFile);
    }

    // Return a cancellation message
    echo json_encode(['message' => 'Your purchase request has been cancelled, welcome to shop next time']);
}
?>
