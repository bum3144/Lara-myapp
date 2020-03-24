<?php

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

# / 라우트의 처리 로직을 'WelcomeController@index'로 연결
# WelcomeController의 index() 메서드에 이 요청의 처리를 위임한다는 뜻
Route::get('/', 'WelcomeController@index');

Route::resource('articles', 'ArticlesController');

Route::get('auth/login', function() {
    $credentials = [
        'email' => 'test@test.com',
        'password' => 'password'
    ];

    if(! auth()->attempt($credentials)){
        return "로그인 정보가 정확하지 않습니다";
    }

    return redirect('protected');
});

// Route::get('protected', function() {
//     dump(session()->all());

//     if(! auth()->check()){
//         return '누구세요??';
//     }

//     return '어서오세요' . auth()->user()->name;
// });

// if절을 사용하지 않고 사용자를 안전하게 다른 위치로 이동시킬 수 있는 방법은 auth 미들웨어다
// auth 미들웨어는 라라벨에 기본적으로 포함되있다. 라우트마다 적용한다고 해서 라우트 미들웨어라고 부른다. 
Route::get('protected', ['middleware' => 'guest', function() {
    // if절 삭제
    // return '어서오세요' . auth()->user()->name;
}]);

Route::get('auth/logout', function(){
    auth()->logout();

    return '또 봐요~!';
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
