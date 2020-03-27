<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Http\Requests\ArticlesRequest; // Illuminate\Http\Request; 대신 사용한다.

class ArticlesController extends Controller
{
   public function index()
   {
        // // N+1 쿼리 문제 해결위해 with()메서드를 체인한다. with() 메서드는 인자로 받은 관계를 미리 로드한다.
        // $articles = \App\Article::with('user')->get(); //즉시로드(eager load)

        // // user() 관계가 필요 없는 다른 로직 수행
        // $articles = \App\Article::get();
        // $articles->load('user');

        // 페이지네이터 - get() 메서드를 paginate()메서드로 바꾸면 끝. (3개씩 표시)
        $articles = \App\Article::latest()->paginate(3); // latest() 날짜 역순 => orderBy('created_at', 'desc')와 같음.

       return view('articles.index', compact('articles'));
   }

   public function create()
   {
      return view('articles.create');
   }

   public function store(ArticlesRequest $request)
   {
      // $rules = [
      //    'title' => ['required'],
      //    'content' => ['required', 'min:10'],
      // ];

      // $messages = [
      //    'title.required' => '제목은 필수 입력 항목입니다.',
      //    'content.required' => '본문은 필수 입력 항목입니다.',
      //    'content.min' => '본문은 최소 :min 글자 이상이 필요합니다.',
      // ];

      // $this->validate($request, $rules, $messages); //trait의 메서드 이용

      // // trait validate()를 사용하므로 생략 가능 
      // $validator = \Validator::make($request->all(), $rules, $messages);
      // if ($validator->fails()){
      //    return back()->withErrors($validator)->withInput();
      // }

      // 실제로는 auth()->user()->articles()-> ... 와 같이 현재 로그인한 사용자 인스턴트를 이용한다
      $article = \App\User::find(1)->articles()->create($request->all());

      if(! $article) {
         return back()->with('flash_message', '글이 저장되지 않았습니다.')->withInput();
      }

      return redirect(route('articles.index'))->with('flash_message', '작성하신 글이 저장되었습니다.');
   }
}
