<?php

Auth::routes();

// Route::get('/', 'WelcomeController@index');

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('articles', 'ArticlesController');

// DB::listen()은 이벤트 리스너다. 데이터베이스에 이벤트가 발생할 때 이벤트를 던진다.
// DB::listen(function ($query) {
//     var_dump($query->sql);
// });