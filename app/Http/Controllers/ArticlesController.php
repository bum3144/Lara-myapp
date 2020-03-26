<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
