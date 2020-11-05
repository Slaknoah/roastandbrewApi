<?php

namespace App\Models;

use App\Notifications\VerifyApiEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendApiEmailVerificationNotification()
    {
        $this->notify( new VerifyApiEmail );
    }

    /**
     * A user has many Companies
     * @return BelongsToMany
     */
    public function companies()
    {
        return $this->belongsToMany('App\Models\Company', 'companies_owners', 'user_id', 'company_id');
    }

    /**
     * A user liked many companies
     */
    public function companiesLiked()
    {
        return $this->belongsToMany('App\Models\Company', 'companies_likes', 'user_id', 'company_id');
    }
}
