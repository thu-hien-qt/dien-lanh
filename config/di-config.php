<?php

use App\Ecommerce\Database;
use App\Ecommerce\Kernel\Kernel;
use App\Ecommerce\Services\MailService;
use Psr\Container\ContainerInterface;

return [
    'db.dsn' => 'mysql:host=localhost;dbname=ecommerce',
    'db.username' => "root",
    'db.password' => "",

    'email.host' => 'smtp.gmail.com',
    'email.username' => 'your_email@gmail.com',
    'email.password' => 'your_app_password',
    'email.port' => 587,
    'email.encryption' => 'tls',
    'email.from_email' => 'your_email@gmail.com',
    'email.from_name' => 'Your Name or Website Name',

    Database::class => function (ContainerInterface $c) {
        return new Database(
            $c->get('db.dsn'),
            $c->get('db.username'),
            $c->get('db.password')
        );
    },

    Kernel::class => function (ContainerInterface $c) {
        return new Kernel($c);
    },

    MailService::class => function (ContainerInterface $c) {
        $emailConfig = [
            'host' => $c->get('email.host'),
            'username' => $c->get('email.username'),
            'password' => $c->get('email.password'),
            'port' => $c->get('email.port'),
            'encryption' => $c->get('email.encryption'),
            'from_email' => $c->get('email.from_email'),
            'from_name' => $c->get('email.from_name'),
        ];
        
        return new MailService($emailConfig);
    },
];
