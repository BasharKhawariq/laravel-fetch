<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RandomUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'dob',
        'phone',
        'job',
        'is_edited',
        'email'
    ];

    protected $dates = ['created_at', 'updated_at', 'last_updated'];

    public static function boot()
    {
        parent::boot();

        static::updating(function ($user) {
            // Set 'last_update' saat ada pembaruan
            $user->last_updated = now();
        });
    }
}
