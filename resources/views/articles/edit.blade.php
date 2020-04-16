@extends('layouts.app')
@section('content')
<div class="page-header">
    <h4>포럼<small> / 글 수정 / {{ $article->title }}</small></h4>
  </div>  
  <hr/>

  <form action="{{ route('articles.update', $article->id) }}" method="POST">
    {!! csrf_field() !!}
    <!-- RESTful -->
    {!! method_field('PUT') !!}

    @include('articles.partial.form')

    <div class="form-group text-right">
        <a href="{!! URL::previous() !!}" class="btn btn-dark">
         <i class="fa fa-pencil"></i> 뒤로가기
        </a>
      <button type="submit" class="btn btn-primary">
      수정하기
      </button>
    </div>    
  </form>
@stop