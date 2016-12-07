<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use App\Game;
use Carbon\Carbon;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\Facades\Cache;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class IndexController extends Controller
{
    private $name;
    private $age;


    /**
     * IndexController constructor.
     * @param $name
     * @param $age
     * Create a new controller instance.
     * @return IndexController
     */
    public function __construct($name,$age)
    {
        $this->age = $age;
        $this->name = $name;
    }

    //

    public function getName()
    {
        return $this->name;
    }


    public function getAge()
    {
        return $this->age;
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
