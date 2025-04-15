<?php
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/controllers/DocentiController.php';
require __DIR__ . '/controllers/ScuoleController.php';

$app = AppFactory::create();

/*Controller delle Scuole*/
$app->get('/scuole', "ScuoleController:index");
$app->get('/scuole/{id:\d+}', "ScuoleController:view");
$app->post('/scuole/create', "ScuoleController:create");
$app->put('/scuole/update', "ScuoleController:update");
$app->delete('/scuole/destroy', "ScuoleController:destroy");

/*Controller dei docenti*/
$app->get('/scuole/{scuola_id:\d+}/docenti', "DocentiController:view");
$app->get('/scuole/docente/{id:\d+}', "DocentiController:search");
$app->post('/scuole/docente/create', "DocentiController:create");
$app->put('/scuole/docente/update', "DocentiController:update");
$app->delete('/scuole/docente/destroy', "DocentiController:destroy");

//documentazione in documentazione.txt//

$app->run();
