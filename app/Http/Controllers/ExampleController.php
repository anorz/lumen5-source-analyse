<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use App\Game;
use Carbon\Carbon;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\Facades\Cache;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //

    public function index()
    {

//        var_dump(app()->make('memcached.connector'));
//        Cache::add('key','xoxo',1);
//        return response(['data'=>app()]);
        dump(app());
    }


    public function xx()
    {

    }


    public function xxx()
    {
        $logger = new Logger(str_replace(__NAMESPACE__,'',__CLASS__.__FUNCTION__));
        $logger->pushHandler(new StreamHandler('../log/xxxxxxxxx.log'));
        $logger->useMicrosecondTimestamps(microtime());
        $logger->log(200,'This is a log',['name'=>'xxxxxxxxxxx']);
        $logger->addInfo('Success');
        dump(Logger::getLevelName(200));
    }
}
