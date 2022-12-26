<?php

namespace Config;


class Auth extends \Myth\Auth\Config\Auth
{
    public $defaultUserGroup = 'regular';

    public $views = [
        'login'           => 'App\Views\Auth\login',
        'register'        => 'App\Views\Auth\register',
    ];    
    
    public $requireActivation = null;

    public $activeResetter = null;

}
