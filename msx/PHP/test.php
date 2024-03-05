<?php

// Your JSON data
$jsonData = '{
    "response": {
        "status": 200,
        "text": "OK",
        "data": {
            "url": "https://msx.benzac.de/media/video1.mp4"
        }
    }
}';

// Set the content type to JSON
header('Content-Type: application/json');

// Output the JSON data
echo $jsonData;
?>