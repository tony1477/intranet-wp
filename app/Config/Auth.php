<?php

namespace Config;


class Auth extends \Myth\Auth\Config\Auth
{
    public $defaultUserGroup = 'regular';

    public $views = [
        'login'           => 'App\Views\Auth\login',
        'register'        => 'App\Views\Auth\register',
        'forgot'          => 'App\Views\Auth\forgot',
        'reset'           => 'App\Views\Auth\reset',
        'emailForgot'     => 'App\Views\email\forgot',
        'confirmMail'    => 'App\Views\Auth\confirm',
    ];    
    
    public $requireActivation = null;

    public $activeResetter = 'Myth\Auth\Authentication\Resetters\EmailResetter';

}
