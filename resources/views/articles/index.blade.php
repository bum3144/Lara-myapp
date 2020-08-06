@extends ('layouts.app')

@section ('content')
    @php $viewName = 'articles.index'; @endphp
    
    <div class="page-header">
        <h4>
            <a href="{{ route('articles.index') }}">
                포럼
            </a>
            <small> / 글 목록</small>
        </h4>
    </div>
    <hr />

    <div class="text-right action__article">
        <a href="{{ route('articles.create') }}" class="btn btn-primary">
            <i class="fa fa-plus-circle"></i> 
                새 글 쓰기
            </i>
        </a>
    </div>

    <div class="row">
        <div class="col-md-3">
            <aside>
                @include('tags.partial.index')
            </aside>
        </div>

        <div class="col-md-9">
            <article>
                @forelse($articles as $article)
                    @include('articles.partial.article', compact('article'))
                @empty
                    <p class="text-center text-danger">글이 없습니다.</p>
                @endforelse
            </article>
        </div>
    </div>

    
    @if($articles->count())
        <div class="text-center paginator__article"> <!-- paging way 2-->
            <!-- appends() 여러개의 쿼리 스트링을 페이지 이동해도 page를 제외한 나머지를 계속 유지 시키기 위해서 -->
        {!! $articles->appends(request()->except('page'))->render() !!}
        </div>
    @endif
@stop