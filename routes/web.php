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

# 기본 라우트
// Route::get('/', function () {
//     return view('welcome');
// });

# 아라비아 숫자, 영대소문자로 구성된 세 자리 글자로 한정 예
// Route::pattern('foo', '[0-9,a-z,A-Z]{3}');
// Route::get('/{foo?}', function ($foo = 'bar'){
//     return $foo;
// });

# where() 메서드를 체인할 수도 있다.
// Route::get('/{foo?}', function ($foo = 'bar') {
//     return $foo;
// })->where('foo', '[0-9,a-z,A-Z]{3}');

// # 라우트 리다이렉션
// Route::get('/', [
//     'as' => 'home',
//     function () {
//         return '안녕 "home" 만나서 반가워';
//     }
// ]);
// Route::get('/home', function () {
//     return redirect(route('home'));
// });

# 데이터 바인딩 1 (with)
// Route::get('/', function () {
//     return view('welcome')->with('name', 'Foo1');
// });

# 데이터 바인딩 2 (with)
// Route::get('/', function () {
//     return view('welcome')->with([
//         'name' => 'Foo2', 
//         'greeting' => 'Hellowith'
//         ]);
// });

# 데이터 바인딩 3 (view) - 보편적인 방법
// Route::get('/', function () {
//     return view('welcome', [
//         'name' => 'Foo3', 
//         'greeting' => 'Helloview'
//         ]);
// });

// # blade 조건문, 반복문 (if, foreach, forelse)
// Route::get('/', function() {
//     // $items = ['apple', 'banana', 'tomato'];
//     $items = [];

//     return view('welcome', ['items' => $items]);
// });

# / 라우트의 처리 로직을 'WelcomeController@index'로 연결
# WelcomeController의 index() 메서드에 이 요청의 처리를 위임한다는 뜻
Route::get('/', 'WelcomeController@index');

Route::resource('articles', 'ArticlesController');
