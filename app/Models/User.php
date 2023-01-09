<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "nickname",
        "email",
        "password",
        "sex",
        "is_banned",
        "is_admin",
        "ip",
        "alliance_id",
        "cached_points",
        "cached_rank",
        "cached_village",
        "approved_at",
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        "password",
        "remember_token",
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        "email_verified_at" => "datetime",
    ];

    /**
     * Tribo que o jogador pertence
     *
     * @return void
     */
    public function alliance()
    {
        return $this->belongsTo( "App\Models\Alliance" );
    }

    public function villages()
    {
        return $this->hasMany( Village::class );
    }

    public function reports()
    {
        return $this->hasMany( Report::class );
    }
}
