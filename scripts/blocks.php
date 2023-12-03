<?php
$jsonFilePath = '../blocks.json';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $fileContent = file_get_contents($jsonFilePath);
    $jsonData = json_decode($fileContent, true);

    $response = ['message' => 'GET request received', 'data' => $jsonData];
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fileContent = file_get_contents($jsonFilePath);
    $jsonData = json_decode($fileContent, true);
    $postData = json_decode(file_get_contents("php://input"), true);

    if (isset($postData['id']) && isset($postData['content'])) {
        $id = $postData['id'];
        $content = $postData['content'];

        $found = false;
        foreach ($jsonData as &$block) {
            if ($block['id'] == $id) {
                $block['content'] = $content;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $newBlock = ['id' => $id, 'content' => $content];
            $jsonData[] = $newBlock;
        }

        file_put_contents($jsonFilePath, json_encode($jsonData));

        $response = ['message' => 'POST request received and processed'];
    } else {
        $response = ['message' => 'Invalid POST data. Both "id" and "content" are required.'];
    }
} else {
    $response = ['message' => 'Unsupported request method'];
}

header('Content-Type: application/json');
echo json_encode($response);