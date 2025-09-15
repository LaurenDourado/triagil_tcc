<?php

return [

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'paciente' => [
            'driver' => 'session',
            'provider' => 'pacientes',
        ],

        'funcionario' => [
            'driver' => 'session',
            'provider' => 'funcionarios',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'pacientes' => [
            'driver' => 'eloquent',
            'model' => App\Models\Paciente::class,
        ],

        'funcionarios' => [
            'driver' => 'eloquent',
            'model' => App\Models\Funcionario::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'pacientes' => [
            'provider' => 'pacientes',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'funcionarios' => [
            'provider' => 'funcionarios',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
