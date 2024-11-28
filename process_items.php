<?php
// Name: Mahesh Pandey Id: 105108938
?>

<?php
header('Content-Type: application/json');

// Load the XML file
$xmlFile = '../../data/goods.xml';
if (file_exists($xmlFile)) {
    $dom = new DOMDocument();
    $dom->load($xmlFile);
    $xpath = new DOMXPath($dom);

    // Query for items where quantitySold is greater than 0
    $nodes = $xpath->query("//item[quantitySold > 0]");
    foreach ($nodes as $node) {
        // Clear quantitySold
        $node->getElementsByTagName('quantitySold')->item(0)->nodeValue = 0;

        // Remove item if quantityAvailable and quantityOnHold are both 0
        $quantityAvailable = $node->getElementsByTagName('quantityAvailable')->item(0)->nodeValue;
        $quantityOnHold = $node->getElementsByTagName('quantityOnHold')->item(0)->nodeValue;

        if ($quantityAvailable == 0 && $quantityOnHold == 0) {
            $node->parentNode->removeChild($node);
        }
    }

    // Save the updated XML
    $dom->save($xmlFile);

    // Return success message
    echo json_encode(['message' => 'Processing complete. Items updated.']);
} else {
    echo json_encode(['message' => 'Error: Goods XML file not found.']);
}
?>
