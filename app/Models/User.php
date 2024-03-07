<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fullname',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];



    public function post(): HasMany
    {
        /*
        NOTE:
        In hasMany, the first parameter is the Model, second and third are optional parameters,
        based on the column defined. Let say say if the foreign key in posts table is called as 'f_key'
        in that case we need to specify second parameter as 'f_key' and the third parameter of the referencing
        column, so in this case it becomes ->hasMany(Post::class, 'f_key', 'id');
        */

        return $this->hasMany(Post::class, 'user_id', 'id');
        // OR the above can be written as hasMany(Post::class); because, eloquent will look in posts table on basis of User Model and append _'id' like -> user + _id = user_id
    }
}
