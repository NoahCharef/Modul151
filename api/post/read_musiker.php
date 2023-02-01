<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once  '../../Model/Database.php';
include_once  '../../Model/Post.php';

$database = new Database();
$db = $database->connect();

$post = new Post($db);

$result = $post->read_musiker();

$rowCount = $result->rowCount();

if($rowCount > 0)
{
    $musiker = array();
    $musiker['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC))
    {
        extract($row);

        $post_item = array(
            'id' => $id,
            'name' => $name,
            'instrument_name' => $instrument_name
        );

        $musiker['data'][] = $post_item;

    }
    echo json_encode($musiker);
}
else
{
    echo json_encode(array('message' => "Keine Musiker"));
}