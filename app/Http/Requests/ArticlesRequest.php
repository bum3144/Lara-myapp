<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticlesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // 사용자가 이 폼 리퀘스트를 주입받는 메서드에 접근할 권한이 있는지를 검사하여 서비스를 보호한다.
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() // 유효성 검사 규칙을 정의한다
    {
        return [
            'title' => ['required'],
            'content' => ['required', 'min:10'],
        ];
    }

    public function messages() // 오류 메시지. :attribute라는 특수한 자리 표시자를 이용. 필드 이름으로 교체된다
    {
        return [
            'required' => ':attribute은(는) 필수 입력 항목입니다.',
            'min' => ':attribute은(는) 최소 :min 글자 이상이 필요합니다.',
        ];
    }

    public function attributes() // 오류 메시지에 표시할 필드 이름을 바꿀수 있다. 이 메서드가 없다면 'title은(는)' 처럼 표시된다
    {
        return [
            'title' => '제목',
            'content' => '본문',
        ];
    }
}
