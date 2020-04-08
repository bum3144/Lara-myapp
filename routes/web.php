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

Route::get('mail', function(){
    $article = App\Article::with('user')->find(1);

    return Mail::send(
        'emails.articles.created', // 메일 본문 템플릿
        compact('article'), // 뷰에 전달할 데이터
        // 클로저는 Illuminate\Mail\Message $message 인자를 받는다
        function ($message) use ($article) { // use 는 클로저 밖에 데이터를 클로저 컨텍스트에 바인팅하는 문법
      //      dd(storage_path('elephant.png'));
            $message->from('ittc@example.com', 'ITTC');
            $message->to('ittc@ittc.kr'); // 메일 수신자
            $message->subject('새 글이 등록되었습니다 - ' . $article->title); // 메일 제목
         //   $message->cc('bum3144@naver.com');
            $message->attach(storage_path('elephant.png')); //storage 디렉터리 아래에 있는 파일의 절대 경로, 첨부 파일 전송 실험
        }

        // // 텍스트 메일
        //        ['text' => 'emails.articles.created-text'],
        //        compact('article'),
        //        function ($message) use ($article) {
        //            $message->to('ittc@ittc.kr');
        //            $message->subject('새 글이 등록되었습니다 -' . $article->title);
        //        }
    );
});


// Route::get('markdown', function(){
//     $text = <<<EOT
//     # 마크다운 예제 1

//     이 문서는 [마크다운][1]으로 썼습니다. 화면에는 HTML로 변환되어 출력됩니다.

//     ## 순서 없는 목록

//     - 첫 번째 항목
//     - 두번째 항목[^1]

//     [1]: http://daringfireball.net/projects/markdown

//     [^1]: 두 번째 항목_ http://google.com
//     EOT;

//     return app(ParsedownExtra::class)->text($text);
// });

// Route::get('docs/{file?}', function ($file = null) {
//     $text = (new App\Documentation)->get($file);

//     return app(ParsedownExtra::class)->text($text);
// });

Route::get('docs/{file?}', 'DocsController@show');

Route::get('docs/images/{image}', 'DocsController@image')
        ->where('image', '[\pL-\pN\._-]+-img-[0-9]{2}.png');

//DB::listen(function ($query) {
//    var_dump($query->sql);
//});