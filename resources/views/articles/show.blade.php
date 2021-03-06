@extends('layouts.app')

@section('content')
  @php $viewName = 'articles.show'; @endphp
      
  <div class="page-header">
    <h4>
      <a href="{{ route('articles.index') }}">포럼</a> 
      <small> / {{ $article->title }}</small>
    </h4>
  </div>  
  <hr/>

  <div class="row container__article">
    <div class="col-md-3 sidebar__article">
      <aside>
        @include('tags.partial.index')
      </aside>
    </div>

    <div class="col-md-9 list__article">
      <article data-id="{{ $article->id }}">
        @include('articles.partial.article', compact('article'))

        <p>{!! nl2br(  markdown($article->content) ) !!}</p>    <hr />   

        @include('tags.partial.list', ['tags' => $article->tags]) 
      </article>

      <div class="text-center action__article">
      @can('update', $article)
        <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-info">
          <i class="fa fa-pencil"></i> 글 수정
        </a>
      @endcan
      @can('delete', $article)
        <button class="btn btn-danger button__delete">
          <i class="fa fa-trash-o"></i> 글 삭제
        </button>
      @endcan
        <a href="{{ route('articles.index') }}" class="btn btn-secondary">
          <i class="fa fa-list"></i> 글 목록
        </a>
      </div>
    </div>
  </div>
@stop


@section('script')
  <script>
    // app.blade.php 헤더에 CSRF 토큰을 읽어서 사용
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('.button__delete').on('click', function (e) {
      var articleId = $('article').data('id');

      if (confirm('글을 삭제합니다.')) {
        $.ajax({
          type: 'DELETE',
          url: '/articles/' + articleId
        }).then(function () {
          window.location.href = '/articles';
        });
      }
    });
  </script>
@stop