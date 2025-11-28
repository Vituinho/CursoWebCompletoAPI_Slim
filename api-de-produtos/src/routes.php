<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");

        // Render index view
        return $container->get('renderer')->render($response, 'index.phtml', $args);
    });

    $app->group('/produtos', function () {

        $this->get('', 'ProductController:getAll');
        $this->get('/{id}', 'ProductController:getOne');
        $this->post('', 'ProductController:create');
        $this->put('/{id}', 'ProductController:update');
        $this->delete('/{id}', 'ProductController:delete');

    });

};
