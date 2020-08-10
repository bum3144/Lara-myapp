@extends ('layouts.app')

@section ('content')
    @php $viewName = 'photo.index'; @endphp

    <div class="page-header">
        <h4>
            게시판
            <small> / <a href="{{ route('photo.index') }}">포토 게시판</a></small>
        </h4>
    </div>
    <hr />

    <div class="row">
        <div class="col-md-3">
            @include('layouts.partial.aside')
        </div>

        <div class="col-md-9">
            <article>
                <p class="text-center text-danger">포토 게시판 입니다</p>
            </article>
        </div>
    </div>

@endsection
