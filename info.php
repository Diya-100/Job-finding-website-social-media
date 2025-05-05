<?php

header('Content-Type: application/json');


$info = [
    'name' => 'Sinthia Siddiqui', 
    'id' => '2110214',
    'personal_notion_page' => 'https://www.notion.so/19672fffbf7380b0b7c0e487fdc9da40?v=19672fffbf7381808c53000ca5abaa11', 
    'personal_group_page_notion' => '', 
    'github_id' => 'sinonym8',
    'project_github_link' => 'https://github.com/Diya-100/Job-finding-website-social-media.git' 
];
<?php

header('Content-Type: application/json');


echo json_encode($info, JSON_PRETTY_PRINT);
?>