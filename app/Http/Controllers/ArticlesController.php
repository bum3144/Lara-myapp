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
        $articles = \App\Article::latest()->paginate(5); // latest() 날짜 역순 => orderBy('created_at', 'desc')와 같음.

       return view('articles.index', compact('articles'));
   }

   public function create()
   {
      return view('articles.create');
   }

   public function store(ArticlesRequest $request)
   {
      $article = \App\User::find(1)->articles()->create($request->all());

      if(! $article) {
         return back()->with('flash_message', '글이 저장되지 않았습니다.')->withInput();
      }

      //var_dump('이벤트를 던집니다');
      event(new \App\Events\ArticlesEvent ($article));
      //var_dump('이벤트를 던졌습니다.');

      return redirect(route('articles.index'))->with('flash_message', '작성하신 글이 저장되었습니다.');
   }

   public function show($id)
   {
      $article = \App\Article::findOrFail($id); 
      // findOrFail($id) $id에 해당하는 모델이 없으면 \Illuminate\Database\Eloquent\ModelNotFoundException 에외를 던진다

      dd($article);

      return $article->toArray();
   }

}
