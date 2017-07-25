<?php

/**
 * Created by PhpStorm.
 * User: MR.L
 * Date: 2017/7/23
 * Time: 12:22
 */
namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Container\Container;
class HomeController
{
    public function index(){
       $student = Student::first();
        $data = $student->getAttributes();
        $app =Container::getInstance();
        $factory = $app->make('view');
        return $factory->make('home')->with('data',$data);
    }
}