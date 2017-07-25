<?php
/**
 * Created by PhpStorm.
 * User: MR.L
 * Date: 2017/7/23
 * Time: 11:42
 */
//model
use Illuminate\Database\Capsule\Manager;
//视图
use Illuminate\Support\Fluent;
require __DIR__.'/../vendor/autoload.php';

$app = new Illuminate\Container\Container;
//视图
Illuminate\Container\Container::setInstance($app);
//实例化服务容器注册事件路由提供者
with(new Illuminate\Events\EventServiceProvider($app))->register();
with(new Illuminate\Routing\RoutingServiceProvider($app))->register();
//启动视图
$app->instance('config', new Fluent());
$app['config']['view.compiled'] = __DIR__."/../storage/framework/views/";
$app['config']['view.paths'] = [__DIR__."/../resource/views/"];
with(new Illuminate\View\ViewServiceProvider($app))->register();
with(new Illuminate\Filesystem\FilesystemServiceProvider($app))->register();
//启动model
$mager = new Manager();
$mager->addConnection(require '../config/database.php');
$mager->bootEloquent();
require __DIR__.'/../app/Http/routes.php';
//实例化请求并分发请求
$request = Illuminate\Http\Request::createFromGlobals();
$response = $app['router']->dispatch($request);
//返回请求响应
$response->send();