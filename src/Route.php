<?php

namespace Friparia\Admin;

use Route as LaravelRoute;

use Illuminate\Support\Str;

class Route{
    public static function admin($model, $prefix = 'admin'){
        $name = Str::snake(class_basename($model));
        $classname = ucfirst($name)."Controller";
        LaravelRoute::get($prefix.'/auth/login', '\Friparia\Admin\Controller@login')->name('admin.login');
        LaravelRoute::post($prefix.'/auth/login', '\Friparia\Admin\Controller@dologin')->name('admin.dologin');
        LaravelRoute::group(['middleware' => ['Friparia\Admin\Middleware']], function () use ($prefix, $name, $classname) {
            LaravelRoute::get($prefix . '/' . $name . '/{action}/{id?}', $classname . '@admin');
            LaravelRoute::post($prefix . '/' . $name . '/{action}/{id?}', $classname . '@admin');
        });
    }

    public static function api($model, $prefix = 'api'){
        $name = Str::snake(class_basename($model));
        $classname = ucfirst($name)."Controller";
        LaravelRoute::get($prefix.'/'.$name, $classname.'@apiList');
        LaravelRoute::get($prefix.'/'.$name.'/show/{id}' , $classname.'@apiShow');
        LaravelRoute::get($prefix.'/'.$name.'/{action}/{id?}', $classname.'@api');
        LaravelRoute::post($prefix.'/'.$name.'/{action}/{id?}', $classname.'@api');
    }

}
