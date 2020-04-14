<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        // User.php 모델에 쿼리 스코프를 사용하여 삭제함
        // // 소셜 사용자를 먼저 찾는다. 소셜 사용자는 이메일은 있지만 비밀번호가 없는 회원
        // $socialUser = \App\User::whereEmail($request->input('email'))->whereNull('password')->first();
        // if($socialUser){ // 회원 가입하려는 사용자가 소셜 사용자라면
        //     return $this->updateSocialAccount($request, $socialUser);
        // }

        // 쿼리 스코프는 scope를 떼고 socialUser()->first()처럼 낙타표기법으로 바꿔 체인해서 쓸 수 있다
        if ($socialUser = \App\User::socialUser($request->get('email'))->first()) {
            return $this->updateSocialAccount($request, $socialUser);
        }       

        // 소셜 사용자가 아니므로 회원가입 폼 처리(기존의 store()메서드의 내용 처리)
        return $this->createNativeAccount($request);
    }

    public function updateSocialAccount(Request $request, \App\User $user)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed|min:6',
        ]);

        // 사용자 이름, 비번 업데이트. 이제 비밀번호가 있고 네이티브/소셜 로그인 두가지 방법으로 로그인 가능
        $user->update([
            'name' => $request->input('name'),
            'password' => bcrypt($request->input('password')),
        ]);

        auth()->login($user);

        return $this->respondCreated($user->name . '님. 환영합니다.');
    }

    public function createNativeAccount(Request $request)
    {
        // 기존에 store()메서드에 있던 내용을 그대로 옮겨옴
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $confirmCode = Str::random(60);

        $user = \App\User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'confirm_code' => $confirmCode,
        ]);

        // 이벤트 리스너에서 메일을 보내기 위임
        event(new \App\Events\UserCreated($user));        

        return $this->respondCreated('가입하신 메일 계정으로 가입 확인 메일을 보내드렸습니다. 가입 확인하시고 로그인해 주세요.');
    }


    protected function respondCreated($message)
    {
        flash($message);

        return redirect('/');
    }

    public function confirm ($code)
    {
        $user = \App\User::whereConfirmCode($code)->first();

        if (! $user) {
            flash('URL이 정확하지 않습니다.');

            return redirect('/');
        }

        $user->activated = 1;
        $user->confirm_code = null;
        $user->save();

        auth()->login($user);
        flash(auth()->user()->name . '님. 환영합니다. 가입 확인되었습니다.');

        return redirect('home');

    }

}
