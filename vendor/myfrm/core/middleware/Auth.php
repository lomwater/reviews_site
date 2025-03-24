<?php

namespace myfrm\middleware;

class Auth
{
    public function handle(): void
    {
        if (!check_auth()) {
            redirect(PATH . '/register');
        }
    }
}