<?php

// Name: Mahesh Pandey Id: 105108938

header('Content-Type: application/json');

// Load the XML file
$xmlFile = '../../data/goods.xml';
if (file_exists($xmlFile)) {
    $dom = new DOMDocument();
    $dom->load($xmlFile);
    $xpath = new DOMXPath($dom);

    $items = [];

    // Query for items where quantitySold is greater than 0
    $nodes = $xpath->query("//item[quantitySold > 0]");
    foreach ($nodes as $node) {
        $items[] = [
            'id' => $node->getElementsByTagName('id')->item(0)->nodeValue,
            'name' => $node->getElementsByTagName('name')->item(0)->nodeValue,
            'price' => $node->getElementsByTagName('price')->item(0)->nodeValue,
            'quantityAvailable' => $node->getElementsByTagName('quantityAvailable')->item(0)->nodeValue,
            'quantityOnHold' => $node->getElementsByTagName('quantityOnHold')->item(0)->nodeValue,
            'quantitySold' => $node->getElementsByTagName('quantitySold')->item(0)->nodeValue,
        ];
    }

    // Return the items as JSON
    echo json_encode($items);
} else {
    echo json_encode([]);
}
?>
