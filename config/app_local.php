<?php
return [
    'debug' => filter_var(env('DEBUG', true), FILTER_VALIDATE_BOOLEAN),

    'Security' => [
        'salt' => env('SECURITY_SALT', 'eb4851611d49f5cb3c1296fa5aca240d7285b24c1b9eb0289fece9618e019bd4'),
    ],

    'Datasources' => [
        'default' => [
            'host' => '127.0.0.1',
            'username' => 'root', 
            'password' => '', 
            'database' => 'personal_agenda_db',
            'url' => env('DATABASE_URL', null),
        ],

        'test' => [
            'host' => 'localhost',
            'port' => 'non_standard_port_number',
            'username' => 'my_app',
            'password' => 'secret',
            'database' => 'test_myapp',
            'url' => env('DATABASE_TEST_URL', 'sqlite://127.0.0.1/tmp/tests.sqlite'),
        ],
    ],

    'EmailTransport' => [
        'default' => [
            'host' => 'localhost',
            'port' => 25,
            'username' => 'arthursiqueiraferreira@outlook.com',
            'password' => '',
            'client' => null,
            'url' => env('EMAIL_TRANSPORT_DEFAULT_URL', null),
            'className' => 'Smtp',
            'tls' => true,
        ],
    ],
];
