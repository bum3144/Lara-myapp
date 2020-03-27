<?php

Auth::routes();

Route::get('/', 'WelcomeController@index');

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('articles', 'ArticlesController');

// 이벤트 레지스트리 (app/Providers/EventServiceProvider.php) 파일로 옮김.
// Event::listen('article.created', function ($article){
//     var_dump('이벤트를 받았습니다. 받은 데이터(상태)는 다음과 같습니다');
//     var_dump($article->toArray());
// });

// DB::listen()은 이벤트 리스너다. 데이터베이스에 이벤트가 발생할 때 이벤트를 던진다.
// DB::listen(function ($query) {
//     var_dump($query->sql);
// });