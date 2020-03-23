
    @extends ('layouts.master')

    @section('style')
        <style>
            body{ background-color: green; color: white; }
        </style>
    @endsection

    @section('content')
        <p>Hello~ I am a Child View 'Content' section.</p>
        
        @include('partials.footer')
    @endsection

    @section('script')
        <script>
            alert("Hello. I am a Child View 'script' section.")
        </script>
    @endsection