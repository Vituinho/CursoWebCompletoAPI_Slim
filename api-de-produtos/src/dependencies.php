<?php

use Slim\App;
use Illuminate\Database\Capsule\Manager as Capsule;

return function (App $app) {
    $container = $app->getContainer();

    // VIEW
    $container['renderer'] = function ($c) {
        $settings = $c->get('settings')['renderer'];
        return new \Slim\Views\PhpRenderer($settings['template_path']);
    };

    // LOGGER
    $container['logger'] = function ($c) {
        $settings = $c->get('settings')['logger'];
        $logger = new \Monolog\Logger($settings['name']);
        $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
        $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
        return $logger;
    };

    $capsule = new Capsule;

    $capsule->addConnection([
        'driver'    => 'mysql',
        'host'      => 'localhost',
        'database'  => 'loja',  // NOME DO SEU BANCO
        'username'  => 'root',
        'password'  => '',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
    ]);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    // disponibiliza o DB no container
    $container['db'] = function ($c) use ($capsule) {
        return $capsule;
    };

    $container['ProductController'] = function ($c) {
        return new \App\Controllers\ProductController($c->get('db'));
    };
};
