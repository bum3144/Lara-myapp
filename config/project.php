<?php

// 프로젝트가 참조할 전역 설정 생성
// '/etc/hosts' 로컬에서 작업을 위하여 가상호스트 추가 '127.0.0.1 myapp.dev'
// '.env' 파일도 'APP_URL=http://myapp.dev:8000' 으로 수정

return [
    'name' => 'My Application',
    'url' => 'http://myapp.dev:8000',
    'desription' => '',
];