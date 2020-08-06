@extends ('layouts.app')

@section ('content')
    @php $viewName = 'board.index'; @endphp

    <div class="page-header">
        <h4>
            <a href="{{ route('board.index') }}">
                Board
            </a>
            <small> / Main</small>
        </h4>
    </div>
    <hr />


    <div class="row">
        <div class="col-md-3">
            <aside>
                <ul class="navbar-nav mr-auto">
                    <li><a href="{{ route('a.index') }}">게시판 1</a></li>
                    <li><a href="#">게시판 2</a></li>
                    <li><a href="{{ route('calendar.index') }}">Calendar</a></li>
                </ul>
            </aside>
        </div>

        <div class="col-md-9">
            <article>
                <p class="text-center text-danger">게시판 메인 입니다</p>
            </article>
        </div>
    </div>

@endsection
