<?php

namespace myfrm\middleware;

class Guest
{
    public function handle(): void
    {
        if (check_auth()) {
            redirect('/home');
        }
    }
}