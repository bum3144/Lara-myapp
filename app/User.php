<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // $date 프로퍼티에 last_login을 추가하면 모델에 접근할 때 카본 인스턴트로 받을 수 있다
    protected $dates = ['last_login'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'confirm_code', 'activated', 'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'confirm_code', 'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'activated' => 'boolean', 'email_verified_at' => 'datetime',
    ]; 


    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    // 소셜 사용자를 조회하는 쿼리는 반복 사용할 가능성이 있어 쿼리스코프로 모델에 선언함
    public function scopeSocialUser($query, $email)
    {
        return $query->whereEmail($email)->whereNull('password');
    }

    public function isAdmin()
    {
        return ($this->id === 1) ? true : false;
    }
}
