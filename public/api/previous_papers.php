<?php
header("Content-Type: application/json");

$data = [
    "constable" => [
        ["title"=>"Constable 2023", "link"=>"https://example.com/constable-2023.pdf"],
        ["title"=>"Constable 2022", "link"=>"https://example.com/constable-2022.pdf"]
    ],
    "group2" => [
        ["title"=>"AP Group 2 2023", "link"=>"https://example.com/group2-2023.pdf"],
        ["title"=>"AP Group 2 2022", "link"=>"https://example.com/group2-2022.pdf"]
    ],
    "ssc" => [
        ["title"=>"SSC CGL 2023", "link"=>"https://example.com/ssc-2023.pdf"],
        ["title"=>"SSC CGL 2022", "link"=>"https://example.com/ssc-2022.pdf"]
    ],
    "rrb" => [
        ["title"=>"RRB ALP 2023", "link"=>"https://example.com/rrb-2023.pdf"],
        ["title"=>"RRB ALP 2022", "link"=>"https://example.com/rrb-2022.pdf"]
    ]
];

echo json_encode($data);
