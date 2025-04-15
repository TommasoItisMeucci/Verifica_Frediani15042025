<?php
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/controllers/DocentiController.php';

$app = AppFactory::create();

$app->get('/scuole/{scuola_id}/docenti', "DocentiController:index");

$app->run();
