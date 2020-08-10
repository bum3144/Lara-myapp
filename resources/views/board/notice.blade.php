@extends ('layouts.app')

@section ('content')
    @php $viewName = 'notice.index'; @endphp

    <div class="page-header">
        <h4>
            게시판
            <small> / <a href="{{ route('notice.index') }}">공지사항</a></small>
        </h4>
    </div>
    <hr />

    <div class="row">
        <div class="col-md-3">
            @include('layouts.partial.aside')
        </div>

        <div class="col-md-9">
            <article>
                <p class="text-center text-danger">공지사항 게시판 입니다</p>
            </article>
        </div>
    </div>

@endsection
