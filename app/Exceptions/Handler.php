<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        // app() 도우미 인자 없이 쓰면 \Illuminate\Foundation\Application 객체를 얻을 수 있다.
        if (app()->environment('production')){ // environment() 메서드 인자로 받은 문자열과 현재의 실행 환경과 비교. 같으면 true 
           $statusCode = 400;
           $title = '죄송합니다. :(';
           $description = '에러가 발생했습니다.';
           dd($code);
            if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException 
                or $exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException){ // instanceof 객체 타입 검사
                    $statusCode = 404;    

                    $description = $exception->getMessage() ?: '요청하신 페이지가 없습니다.';
            }
                return response (view('errors.notice',[
                    'title' => $title,
                    'description' => $description,
                ]), $statusCode); // .env APP_ENV=prodection , 또는 config/app.php 파일에서 env키의 값을 바꾸어도 됨
            
        }

        return parent::render($request, $exception);
    }
}
