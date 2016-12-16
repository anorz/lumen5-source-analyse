<?php

namespace Illuminate\Contracts\Container;

use Closure;

interface Container
{
    /**
     * Determine if the given abstract type has been bound.
     *
     * @param  string  $abstract
     * @return bool
     *
     * 判断是否在 instance bindings aliases 中存在
     * return isset($this->bindings[$abstract]) || isset($this->instances[$abstract]) || $this->isAlias($abstract);
     */
    public function bound($abstract);

    /**
     * Alias a type to a different name.
     *
     * @param  string  $abstract
     * @param  string  $alias
     * @return void
     * 为一个类设置别名
     * 例如:
     *  dump($app->alias(mysqli::class,'xoxoxoxoxmmysql'));
        $mysqli = $app->make('xoxoxoxoxmmysql',['host'=>'127.0.0.1','user'=>'root','password'=>'','database'=>'nodeapi','port'=>3306,'socket'=>'']);
        $result = $mysqli->query("select * from origin_api");
        dump($result->fetch_array());
     */
    public function alias($abstract, $alias);

    /**
     * Assign a set of tags to a given binding.
     *
     * @param  array|string  $abstracts
     * @param  array|mixed   ...$tags
     * @return void
     *
     */
    public function tag($abstracts, $tags);

    /**
     * Resolve all of the bindings for a given tag.
     *
     * @param  array  $tag
     * @return array
     */
    public function tagged($tag);

    /**
     * Register a binding with the container.
     *
     * @param  string|array  $abstract
     * @param  \Closure|string|null  $concrete
     * @param  bool  $shared
     * @return void
     * 绑定一个服务到容器中，若$concrete为闭包函数，这函数的参数为2个，一个全局的$app,一个接受make时传递的参数的数组类型
     * $app->bind('xoxo', function($app, array $array){

        });
     *
     *  $app->make('xoxo',array $array); make传递的参数必须为数组
     *
     *  当$abstract为数组时：
     *  $app->bind([mysqli::class=>'xoxoxoxoxmmysql']);
     *  等价于
     *  $app->bind('xoxoxoxoxmmysql',mysqli::class);
     *
     */
    public function bind($abstract, $concrete = null, $shared = false);

    /**
     * Register a binding if it hasn't already been registered.
     *
     * @param  string  $abstract
     * @param  \Closure|string|null  $concrete
     * @param  bool  $shared
     * @return void
     */
    public function bindIf($abstract, $concrete = null, $shared = false);

    /**
     * Register a shared binding in the container.
     *
     * @param  string|array  $abstract
     * @param  \Closure|string|null  $concrete
     * @return void
     */
    public function singleton($abstract, $concrete = null);

    /**
     * "Extend" an abstract type in the container.
     *
     * @param  string    $abstract
     * @param  \Closure  $closure
     * @return void
     *
     * @throws \InvalidArgumentException
     *
     * 为绑定的服务添加一个拓展
     *
     */
    public function extend($abstract, Closure $closure);

    /**
     * Register an existing instance as shared in the container.
     *
     * @param  string  $abstract
     * @param  mixed   $instance
     * @return void
     */
    public function instance($abstract, $instance);

    /**
     * Define a contextual binding.
     *
     * @param  string  $concrete
     * @return \Illuminate\Contracts\Container\ContextualBindingBuilder
     * 有时侯我们可能有两个类使用同一个接口，但我们希望在每个类中注入不同实现，
     * 例如，当系统接到一个新的订单的时候，我们想要通过PubNub而不是Pusher发送一个事件。
     * Laravel定义了一个简单、平滑的方式来定义这种行为：
     * $this->app->when('App\Handlers\Commands\CreateOrderHandler')
            ->needs('App\Contracts\EventPusher')
            ->give('App\Services\PubNubEventPusher');
     *
     * 你甚至还可以传递一个闭包到give方法：
     * $this->app->when('App\Handlers\Commands\CreateOrderHandler')
            ->needs('App\Contracts\EventPusher')
            ->give(function () {
                    // Resolve dependency...
            });
     *
     */
    public function when($concrete);

    /**
     * Resolve the given type from the container.
     *
     * @param  string  $abstract
     * @param  array   $parameters
     * @return mixed
     */
    public function make($abstract, array $parameters = []);

    /**
     * Call the given Closure / class@method and inject its dependencies.
     *
     * @param  callable|string  $callback
     * @param  array  $parameters
     * @param  string|null  $defaultMethod
     * @return mixed
     */
    public function call($callback, array $parameters = [], $defaultMethod = null);

    /**
     * Determine if the given abstract type has been resolved.
     *
     * @param  string $abstract
     * @return bool
     * 判断服务器是否已经成功充容器中make出来
     */
    public function resolved($abstract);

    /**
     * Register a new resolving callback.
     *
     * @param  string    $abstract
     * @param  \Closure|null  $callback
     * @return void
     *
     */
    public function resolving($abstract, Closure $callback = null);

    /**
     * Register a new after resolving callback.
     *
     * @param  string    $abstract
     * @param  \Closure|null  $callback
     * @return void
     */
    public function afterResolving($abstract, Closure $callback = null);
}
