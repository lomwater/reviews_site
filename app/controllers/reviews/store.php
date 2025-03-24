<?php

use myfrm\Db;
use myfrm\Validator;
use myfrm\App;

$db = App::get(Db::class);

$formData = ['name', 'description'];
$data = formCheck($formData);

if (isset($_FILES['reviewsImage']) && $_FILES['reviewsImage']['error'] === 0) {
    $data['reviewsImage'] = $_FILES['reviewsImage'];
} else {
    $data['reviewsImage'] = [];
}

$rules = [
    'name' => [
        'required' => true,
        'min' => 2,
        'max' => 20,
    ],
    'description' => [
        'required' => true,
        'min' => 2,
        'max' => 255,
    ],
//    'reviewsImage' => [
//        'required' => true,
//        'ext' => 'jpg:png',
//        'size' => 2097152,
//    ]
];

if (isset($_FILES['reviewsImage'])) {
    $data['reviewsImage'] = $_FILES['reviewsImage'];
} else {
    $data['reviewsImage'] = [];
}

$validation = (new Validator())->validate($data, $rules);
if (!$validation->hasErrors()) {
    $db->query("INSERT INTO reviews (`name`, `description`) VALUES (?, ?)", [$data['name'], $data['description']]);
    if (is_array($data['reviewsImage']['name'])) {
        foreach ($data['reviewsImage']['name'] as $key => $value) {
            $arrayNameImage = explode('.', $value);
            $file_extension = end($arrayNameImage);
            $id = $db->getInsertId();
            $dir = '/reviews/' . date('Y') . '/' . date('m') . '/' . date('d');
            if (!file_exists($dir)) {
                mkdir(UPLOADS . $dir, 0777, true);
            }
            $file_path = UPLOADS . "{$dir}/avatar-{$id}.{$file_extension}";
            $file_url = "/uploads/{$dir}/reviews-avatar-{$id}.{$file_extension}";
            if (move_uploaded_file($data['reviewsImage']['tmp_name'][0  ], $file_path)) {
                $db->query("UPDATE reviews SET reviewsImage = ? WHERE id = ?", [$file_url, $id]);
            } else {
                $_SESSION['reviewsError'] = 'Error uploading avatar';
            }
        }
        $_SESSION['success'] = 'Your reviews have been saved';
    } else {
        $_SESSION['error'] = 'Error uploading avatar';
    }
    redirect('/home');
} else {
    redirect('/reviews');
}