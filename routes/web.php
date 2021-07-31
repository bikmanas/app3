<?php

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// class Person
// {
//     public $age;
//     public $name;
//     public function __construct($age, $name)
//     {
//         $this->age = $age;
//         $this->name = $name;
//     }
// }


Route::get('/{id}', function ($id) {
    return $id;
})->where('id', '[0-9]+');

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::get('/about', function () {
    return view('about');
})->name('regular.about');

Route::group(['prefix' => 'test'], function () {
    Route::get('/home', function () {
        return redirect()->route('test.root');
    });

    Route::get('/arr', function () {
        return view('test', ["letters" => ["A", "B", "C"]]);
    });

    Route::get('/{param}', function ($param) {
        return view('test', ["var" => $param]);
    })->name('test.root');
});

Route::any('/{any}', function () {
    print("404 - No such route, buddy!");
})->where('any', '.*');
