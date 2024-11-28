<?php
// Name: Mahesh Pandey Id: 105108938
?>

<?php


header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Checking if the required data is available
        if (!isset($_POST['id']) || !isset($_POST['action'])) {
            throw new Exception("Invalid request parameters.");
        }

        $itemId = trim($_POST['id']);
        $action = trim($_POST['action']);
        $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1; // Default quantity to 1

        $xmlFile = '../../data/goods.xml';

        if (!file_exists($xmlFile)) {
            throw new Exception("Goods XML file not found.");
        }

        // Loading the XML document
        $dom = new DOMDocument();
        $dom->load($xmlFile);
        $xpath = new DOMXPath($dom);

        // Finding the item in the XML by its ID
        $itemNode = $xpath->query("//item[id='$itemId']")->item(0);
        if (!$itemNode) {
            throw new Exception("Item with ID $itemId not found.");
        }

        // Process the action: either 'add' or 'remove'
        $quantityAvailableNode = $itemNode->getElementsByTagName('quantityAvailable')->item(0);
        $quantityOnHoldNode = $itemNode->getElementsByTagName('quantityOnHold')->item(0);

        $quantityAvailable = intval($quantityAvailableNode->nodeValue);
        $quantityOnHold = intval($quantityOnHoldNode->nodeValue);

        if ($action === 'add') {
            if ($quantityAvailable > 0) {
                // Reduce available quantity and increase on hold
                $quantityAvailableNode->nodeValue = $quantityAvailable - 1;
                $quantityOnHoldNode->nodeValue = $quantityOnHold + 1;
            } else {
                throw new Exception("No available quantity for item $itemId.");
            }
        } elseif ($action === 'remove') {
            // Increase available quantity and reduce on hold
            $quantityAvailableNode->nodeValue = $quantityAvailable + $quantity;
            $quantityOnHoldNode->nodeValue = $quantityOnHold - $quantity;
        } else {
            throw new Exception("Invalid action: $action");
        }

        // Saving updated XML
        $dom->save($xmlFile);

        // Return success message as JSON
        echo json_encode(['success' => true]);
    } else {
        throw new Exception("Invalid request method.");
    }
} catch (Exception $e) {
    // Catch and return any exceptions as JSON errors
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
