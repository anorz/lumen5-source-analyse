<?php
/**
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
 * @var $app \Laravel\Lumen\Application
 *
 * group 中的属性包含   middleware  prefix  suffix  namespace
 * 在使用中间件时候，多个中间件用 | 分割
 */
$app->group(['namespace'=>'App\Http\Controllers'],function ()use($app){
    $app->get('/', function () use ($app) {
        return $app->version();
    });
    $app->get('/x',['as'=>'x',function(){
        return $_GET['id'];
    }]);
    $app->get('/api',['uses'=>'IndexController@api']);
    $app->get('/o/{id:[0-9]{1,}}',['uses'=>'ExampleController@xx','as'=>'xx']);
    $app->get('/debug',function()use($app){
        dump($app);
    });
    $app->get('{type:test|xx}/{id:[1-9]{1,}}',['as'=>'xx',function ($id) use ($app){
        return route('x',['id'=>md5($id)]);
    }]);
});
