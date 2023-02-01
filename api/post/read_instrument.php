<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once  '../../Model/Database.php';
include_once  '../../Model/Post.php';

$database = new Database();
$db = $database->connect();

$post = new Post($db);

$result = $post->read_instrument();

$rowCount = $result->rowCount();

if($rowCount > 0)
{
    $instrument = array();
    $instrument['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC))
    {
        extract($row);


        $post_item = array(
            'id' => $id,
            'instrumentname' => $instrumentname
        );

        $instrument['data'][] = $post_item;

    }
    echo json_encode($instrument);
}
else
{
    echo json_encode(array('message' => "Keine Musiker"));
}