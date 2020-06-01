<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'second_name', 'birth_date', 'status', 'id_group'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'birth_date' => 'datetime',
    ];

    public function classroom()
    {
            return $this->hasOne('App\Classroom', 'id_assistant', 'id');
    }

    public function group()
    {
        return $this->belongsTo('App\Group', 'id', 'id_group');
    }

    public function pairs()
    {
        return $this->hasMany('App\Pair', 'id_user_student', 'id');
    }

    public function schedules()
    {
        return $this->hasMany('App\Schedule', 'id_teacher', 'id');
    }
}
