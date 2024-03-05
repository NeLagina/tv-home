<?php

// Function to fetch JSON data from a URL
function getJsonData($url) {
    $json = file_get_contents($url);
    return json_decode($json, true);
}

// JSON structure template
$templateJson = '
{
    "type": "pages",
    "template": {
        "icon": "panel",
        "color": "msx-glass",
        "type": "teaser"
    },
    "pages": [
        {
            "items": [
                {
                    "layout": "0,0,15,4",
                    "title": "Random Film",
                    "image": "The film images",
                    "action": "video:THE URL of the video"
                },
                {
                    "layout": "2,3,2,2",
                    "title": "%comming soon%",
                    "image": "IMAGES FOR COMMING"
                }
            ]
        }
    ]
}
';

// Decode the template JSON
$templateData = json_decode($templateJson, true);

// Update the "Random Film" section with a random video URL
$watchNowJson = getJsonData("https://nelagina.github.io/tv-home/msx/php/watchnow.json");
$randomVideoUrl = $watchNowJson['data']['url'];
$templateData['pages'][0]['items'][0]['action'] = "video:" . $randomVideoUrl;

// Update the "%comming soon%" section with data from commingsoon.json
$commingSoonJson = getJsonData("https://nelagina.github.io/tv-home/msx/php/commingsoon.json");
$templateData['pages'][0]['items'][1]['title'] = $commingSoonJson['title'];
$templateData['pages'][0]['items'][1]['image'] = $commingSoonJson['image'];

// Convert the updated array to JSON
$jsonResponse = json_encode($templateData, JSON_PRETTY_PRINT);

// Set the appropriate header for JSON response
header('Content-Type: application/json');

// Output the JSON response
echo $jsonResponse;
?>
