@extends('layouts.app')

@section('content')
<div class="container">
    <h1>
      {{ $article->title }}
    </h1>

    <hr/>

    <article>
      {!! app(ParsedownExtra::class)->text($article->content) !!}
      <hr />
      <p><i>입력된 내용에서 줄바꿈이 유지되길 원할 때 "nl2br" 사용</i></p>
      {!! nl2br( app(ParsedownExtra::class)->text($article->content) ) !!}
      <small>
        by {{ $article->user->name }}
        {{ $article->created_at->diffForHumans() }}
      </small>
    </article>
</div>
@stop