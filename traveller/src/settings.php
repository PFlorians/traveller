<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header
        'mode' => 'development',
        //databse connection for srvcattendance
        'db'=>[
            'host'=>'CZECLBRNPFL1\SQLEXPRESS',
            'conn_string' => [
                'Database' => 'attendance_dev',//,
                'ReturnDatesAsStrings' => true
                /*'UID'=>'sparrow\\hackerman',
                'PWD'=>'HeroOfOrion1988',
                'CharacterSet' => 'UTF-8'*/
            ]
        ],
        //ldap srvc account credentials
        'ldap'=>[
                'controller_hostname' => 'DEUDCFRAN2002',
                'ldap_port' => 389,
                'domain' => 'grouphc.net',
                'login' => 'grpsrvcattendancedev',
                'password' => 'rxC2F71'
        ],
        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
    ],
];
