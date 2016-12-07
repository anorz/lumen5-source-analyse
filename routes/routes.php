<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});
$app->get('/x','ExampleController@index');
$app->get('/xxx','ExampleController@xxx');
$app->get('/o/{id:[0-9]{1,}}',['uses'=>'ExampleController@xx','as'=>'xx']);
$app->get('/oo','ExampleController@xxx');
$app->get('{type:test|xx}',function () use ($app){
//    $app->extend('index',function (){
//        echo "xxx";
//    });
//    $app->extend('index',function (){
//        echo "0000";
//    });
//    $index = $app->make('index',['age'=>18,'name'=>'xck']);
//    dump($app);
//    dump($app->resolved('index'));

    dump(\Illuminate\Container\Container::getInstance()==$app);


});


