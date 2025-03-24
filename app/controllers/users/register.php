<?php

use myfrm\App;
use myfrm\Validator;
use myfrm\Db;

$tile = 'Register';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = App::get(myfrm\Db::class);
    $fillable = ['firstname', 'lastname', 'email', 'password', 'passwordrepeat'];
    $data = formCheck($fillable);
    $validation = new Validator();
    $rules = [
        'firstname' => [
            'required' => true,
            'min' => 1,
            'max' => 50,
        ],
        'lastname' => [
            'required' => true,
            'min' => 1,
            'max' => 50,
        ],
        'email' => [
            'required' => true,
            'email' => true,
            'unique' => 'users:email',
        ],
        'password' => [
            'required' => true,
            'min' => 8,
            'max' => 100,
        ],
        'passwordrepeat' => [
            'match' => 'password',
        ]
    ];

    $validation->validate($data, $rules);

    if (!$validation->hasErrors()) {
        unset($data['passwordrepeat']);
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        if ($db->query("INSERT INTO users (`firstname`, `lastname`, `email`, `password`) VALUES (:firstname, :lastname, :email, :password)", $data)) {
            $_SESSION['success'] = 'Registered';
            $_SESSION['user'] = $data['firstname'];
        } else {
            $_SESSION['error'] = 'Something went wrong';
        }
        redirect('/home');
    }

}


require VIEWS . '/users/register.view.php';