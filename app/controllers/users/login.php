<?php

use myfrm\App;
use myfrm\Validator;

$tile = 'Login';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = App::get(myfrm\Db::class);
    $data = formCheck(['firstname', 'lastname', 'email', 'password']);

    $rules = [
        'firstname' => [
            'required' => true,
        ],
        'lastname' => [
            'required' => true,
        ],
        'email' => [
            'required' => true,
        ],
        'password' => [
            'required' => true,
        ]
    ];

    $validation = new Validator();

    if (!$validation->hasErrors()) {
        if (!$user = $db->query("SELECT email, password, firstname FROM users WHERE email = ?", [$data['email']])->find()) {
            $_SESSION['error'] = 'Wrong email or password';
            redirect();
        }

        if (!password_verify($data['password'], $user['password'])) {
            $_SESSION['error'] = 'Wrong email or password';
            redirect();
        }

        $_SESSION['user'] = $user['firstname'];

        $_SESSION['success'] = 'Successful login';
        redirect('/home');
    }
}


require VIEWS . '/users/login.view.php';