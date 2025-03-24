<?php

use myfrm\App;
use myfrm\Db;

$db = App::get(Db::class);

$api_data = json_decode(file_get_contents("php://input"), 1);

$data = $api_data ?? $_POST;
$id = $data['id'] ?? 0;
$db->query("DELETE FROM reviews WHERE id= ?", [$id]);

if ($db->rowCount()) {
    $result['answer'] = $_SESSION['success'] = 'Post deleted';
} else {
    $result['answer'] = $_SESSION['error'] = 'Something went wrong';
}

if ($api_data) {
    echo json_encode($result);
    die;
}

