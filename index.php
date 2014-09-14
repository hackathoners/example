<?php
require 'vendor/autoload.php';

use \MarkupTranslator\Translator;

$app = new \Slim\Slim();
$app->get('/', function () use ($translator, $app) {
    $app->render('index.tpl.php', [
        'markups' => Translator::getMarkups()
    ]);
});

$app->post('api/v1/translate', function () use ($app) {
    $app->response->headers->set('Content-Type', 'application/json');
    $result = Translator::translate(
        $app->request->post('text'),
        $app->request->post('from'),
        $app->request->post('to')
    );
    $app->response->setBody(json_encode(
        [
            'result' => $result
        ]
    ));
});

$app->run();
