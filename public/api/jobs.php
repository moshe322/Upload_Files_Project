<?php
header("Content-Type: application/json");

$url = "https://www.freejobalert.com/feed/";
$xml = simplexml_load_file($url);

$jobs = [];

foreach ($xml->channel->item as $item) {
    $jobs[] = [
        "title" => (string)$item->title,
        "link" => (string)$item->link,
        "date" => (string)$item->pubDate
    ];
}

echo json_encode($jobs);
