<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Http\Requests\ArticlesRequest; // Illuminate\Http\Request; 대신 사용한다.

class ArticlesController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth', ['except' => ['index', 'show']]);
   }

   public function index($slug = null)
   {
         $query = $slug 
            ? \App\Tag::whereSlug($slug)->firstOrFail()->articles() 
            : new \App\Article;

        // // N+1 쿼리 문제 해결위해 with()메서드를 체인한다. with() 메서드는 인자로 받은 관계를 미리 로드한다.
        // $articles = \App\Article::with('user')->get(); //즉시로드(eager load)

        // // user() 관계가 필요 없는 다른 로직 수행
        // $articles = \App\Article::get();
        // $articles->load('user');

        // 페이지네이터 - get() 메서드를 paginate()메서드로 바꾸면 끝. (3개씩 표시)
        // $articles = \App\Article::latest()->paginate(5); // latest() 날짜 역순 => orderBy('created_at', 'desc')와 같음.
        $articles = $query->latest()->paginate(3); // latest() 날짜 역순 => orderBy('created_at', 'desc')와 같음.

       return view('articles.index', compact('articles'));
   }

   public function create()
   {
      $article = new \App\Article;

      return view('articles.create', compact('article'));
   }

   public function store(\App\Http\Requests\ArticlesRequest $request)
   {
      //$article = \App\User::find(1)->articles()->create($request->all());
      $article = $request->user()->articles()->create($request->all());

      if(! $article) {
         return back()->with('flash_message', '글이 저장되지 않았습니다.')->withInput();
      }
      $article->tags()->sync($request->input('tags'));

      //var_dump('이벤트를 던집니다');
      event(new \App\Events\ArticlesEvent ($article));
      //var_dump('이벤트를 던졌습니다.');

      return redirect(route('articles.index'))->with('flash_message', '작성하신 글이 저장되었습니다.');
   }

   public function show(\App\Article $article)
   {

      // RouteServiceProvider 라우트 (명시적) 모델 바인딩을 이용하므로 모델 인스턴스를 조회하는 구문은 필요없음
      // $article = \App\Article::findOrFail($id); 
      // debug($article->toArray());
      
      return view('articles.show', compact('article'));
   }

   public function edit(\App\Article $article)
   {
      $this->authorize('update', $article);

      return view('articles.edit', compact('article'));
   }

   public function update(\App\Http\Requests\ArticlesRequest $request, \App\Article $article)
   {
      $article->update($request->all());
      $article->tags()->sync($request->input('tags'));
      flash()->success('수정하신 내용을 저장했습니다.');

      return redirect(route('articles.show', $article->id));
   }

   public function destroy(\App\Article $article)
   {
      $this->authorize('delete', $article);

      $article->delete();

      return response()->json([], 204);
   }

}
