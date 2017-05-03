<?php

use Phalcon\Loader;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt;
use Phalcon\Mvc\Application;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;



// Register an autoloader
$loader = new Loader();

$loader->registerDirs(
    [
        "../app/controllers/",
        "../app/models/",
    ]
);

$loader->register();



// Create a DI
$di = new FactoryDefault();

// Register Volt as a service
$di->set(
    "voltService",
    function ($view, $di) {
        $volt = new Volt($view, $di);

        $volt->setOptions(
            [
                "compiledPath"      => "../app/compiled-templates/",
                "compiledExtension" => ".compiled",
            ]
        );

        return $volt;
    }
);

// Setup the view component
$di->set(
    "view",
    function () {
        $view = new View();

        $view->setViewsDir("../app/views/");

        $view->registerEngines(
            [
                ".volt" => "voltService",
            ]
        );

        return $view;
    }
);

// Setup a base URI so that all generated URIs include the "tutorial" folder
$di->set(
    "url",
    function () {
        $url = new UrlProvider();

        $url->setBaseUri("/");

        return $url;
    }
);

$di->set('router', function() {

    $router = new Router();

    $router->add("/", 'Index::index');
    $router->add("/news", 'Index::news');
    $router->add("/news/{id}", 'Index::newsArticle');
    $router->add("/activities/{id}", 'Index::activitiesArticle');
    $router->add("/admin", 'Index::login');
    $router->add("/verify_login", 'Index::verifyLogin');
    $router->add("/newArticle", 'Index::newArticle');
    $router->add("/newUser", 'Index::newUser');
    $router->add("/saveNewUser", 'Index::newUser');
    $router->add("/aboutus/documents", 'Index::documents');
    $router->add("/document/{id}", 'Index::document');
    $router->add("/aboutus/history", 'Index::ourHistory');


    return $router;
});

// Setup the database service
$di->set(
    "db",
    function () {
        return new DbAdapter(
            [
                "host"     => "localhost",
                "username" => "root",
                "password" => "",
                "dbname"   => "lza",
                'charset'   =>'utf8'
            ]
        );
    }
);



$application = new Application($di);

try {
    // Handle the request
    $response = $application->handle();

    $response->send();
} catch (\Exception $e) {
    echo "Exception: ", $e->getMessage();
}
