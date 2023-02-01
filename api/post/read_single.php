<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../Model/Database.php';
include_once '../../Model/Post.php';

$database = new Database();
$db = $database->connect();

$post = new Post($db);

$post->id = $_GET['id'] ?? die();

$post->read_single();

$post_arr = array(
    'id' => $post->id,
    'musiker_name' => $post->musiker_name,
    'instrument_name' => $post->instrument_name
);

// Make JSON
print_r(json_encode($post_arr));