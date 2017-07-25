<?php
/**
 * Created by PhpStorm.
 * User: MR.L
 * Date: 2017/7/23
 * Time: 11:41
 */
$app['router']->get('/',function(){
    return '<h1>路由创建成功</h1>';
});
$app['router']->get('/home','App\Http\Controllers\HomeController@index');