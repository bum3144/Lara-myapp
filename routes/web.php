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

# 라우트 리다이렉션
Route::get('/', [
    'as' => 'home',
    function () {
        return '안녕 "home" 만나서 반가워';
    }
]);
Route::get('/home', function () {
    return redirect(route('home'));
});
