<?php

namespace App\Models;

use App\Helpers\Enums\Roles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
        'name',
        'surname',
        'email',
        'phone',
        'birthdate',
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
    ];

    // строим связь между таблицами, метод через который мы можем обращаться к роли пользователя
    // (один пользователь может принадлежать только к одной роли)
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function wishes()
    {
        return $this->belongsToMany(
            Product::class,
            'wish_list',
            'user_id',
            'product_id'
        );
    }

    public function addToWish(Product $product)
    {
        $this->wishes()->attach($product);
    }

    public function removeFromWish(Product $product)
    {
        $this->wishes()->detach($product);
    }


}
