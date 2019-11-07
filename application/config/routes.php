<?php
    return [

        '' => [
            'controller' => 'main',
            'action' => 'index',
        ],

       'account/login' => [
            'controller' => 'account',
            'action' => 'login',
        ],

        'account/register' => [
            'controller' => 'account',
            'action' => 'register',
        ],

        'account/confirm/{link:\w+}' => [
            'controller' => 'account',
            'action' => 'confirm',
        ],

        'account/newpass' => [
            'controller' => 'account',
            'action' => 'newpass',
        ],

        'account/profile' => [
            'controller' => 'account',
            'action' => 'profile',
        ],

        'gallery' => [
            'controller' => 'gallery',
            'action' => 'show',
        ],

        /*'gallery/photo/{id:\w+}' => [
          'controller' => 'gallery',
          'action' => 'photo',
        ],*/
    ];
