<footer>
    <p>I am footer. Adopt me from a different view.(footer.blade)</p>
</footer>

@section('script')
        @parent
        <!-- 동일한 세션네임이 있는 경우 @parent로 해결가능, -->
        <script>
            document.write("<p>Hello. I am a Child View 'script' section.(footer.blade-script)</a>")
        </script>
@endsection