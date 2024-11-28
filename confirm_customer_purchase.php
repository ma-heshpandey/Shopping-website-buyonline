<?php
// Name: Mahesh Pandey Id: 105108938
?>

<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cart = json_decode($_POST['cart'], true);
    $xmlFile = '../../data/goods.xml';
    $totalAmount = 0;

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
                // Update the quantity on hold and quantity sold
                $quantityOnHold = $itemNode->getElementsByTagName('quantityOnHold')->item(0);
                $quantitySold = $itemNode->getElementsByTagName('quantitySold')->item(0);
                $quantityOnHold->nodeValue -= $quantity;
                $quantitySold->nodeValue += $quantity;

                // Add to the total amount
                $price = $itemNode->getElementsByTagName('price')->item(0)->nodeValue;
                $totalAmount += $price * $quantity;
            }
        }

        // Save the changes to the XML
        $dom->save($xmlFile);
    }

    // Return the total amount due
    echo json_encode(['message' => "Your purchase has been confirmed and total amount due to pay is $$totalAmount"]);
}
?>
