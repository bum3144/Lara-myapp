<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use File;
// 데이터베이스를 사용하지 않기 때문에 엘로퀀트를 상속하지 않는다. 
// extends Model 삭제. 이 모델은 쓰기, 수정, 삭제 기능이 필요없고 사용자 요청파일을 읽어서 반환하기만 하면 된다.
class Documentation 
{
    public function get($file = 'documentation.md')
    {
        $content = File::get($this->path($file));
        //dd($file);
        return $this->replaceLinks($content);
    }

    public function image($file)
    {
        // dd($file);
        return \Image::make($this->path($file, 'docs/images'));
    }

    protected function path($file, $dir = 'docs')
    {
        
        // ends_with() X => Str::endsWith() 로 변경함
        $file = Str::endsWith($file, ['.md', '.png']) ? $file : $file . '.md';     
        $path = base_path($dir . DIRECTORY_SEPARATOR . $file);
        if (! File::exists($path)) {
            abort(404, '요청하신 파일이 없습니다.');
        }

        return $path;
    }

    protected function replaceLinks($content)
    {
        return str_replace('/docs/{{version}}', '/docs', $content);
    }


    public function etag($file)
    {
        $lastModified = File::lastModified($this->path($file, 'docs/images'));
        return md5($file . $lastModified);
    }
}
