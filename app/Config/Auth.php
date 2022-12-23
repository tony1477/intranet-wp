<?php namespace Config;

use CodeIgniter\Config\BaseConfig;
use Myth\Auth\Config\Auth as AuthConfig;

class Auth extends AuthConfig
{

    public $views = [
        'login'           => 'App\Views\Auth\login',
        'register'        => 'App\Views\Auth\register',
    ];

}