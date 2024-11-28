<?php
// Name: Mahesh Pandey Id: 105108938
?>

<?php

header('Content-Type: application/json');

// Path to the goods.xml file
$xmlFile = '../../data/goods.xml';

if (file_exists($xmlFile)) {
    $xml = simplexml_load_file($xmlFile);
    $items = [];

    // Loop through each item in the XML and filter based on quantityAvailable > 0
    foreach ($xml->item as $item) {

            $items[] = [
                'id' => (string)$item->id,
                'name' => (string)$item->name,
                        // Sending only 20 character of description
                'description' => substr((string)$item->description, 0, 20),  // First 20 characters of description
                'price' => (float)$item->price,
                'quantityAvailable' => (int)$item->quantityAvailable
            ];
    
    }

    // Return the filtered items as JSON
    echo json_encode($items);
} else {
    echo json_encode([]);
}
?>
