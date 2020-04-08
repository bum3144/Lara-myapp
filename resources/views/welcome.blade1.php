
    @extends ('layouts.master')

    @section('style')
        <style>
            body{ background-color: green; color: white; }
        </style>
    @endsection

    @section('content')
        <p>Hello~ I am a Child View 'Content' section.(content)</p>
        
        @include('partials.footer')
    @endsection

    @section('script')
        <script>
            document.write("<p>Hello. I am a Child View 'script' section. (welcome.blade-script)</p>")
        </script>
    @endsection