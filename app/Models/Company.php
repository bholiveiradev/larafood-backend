<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'cnpj',
        'name',
        'url',
        'email',
        'logo',
        'is_active',
        'subscription',
        'expires_at',
        'subscription_id',
        'subscription_active',
        'subscription_suspended',
        'subscription_suspended_at'
    ];

    public static function boot()
    {
        parent::boot();

        self::updating(function (Model $model) {

            $model->subscription_suspended 
                ? $model->subscription_suspended_at = now() 
                : $model->subscription_suspended_at = null;
        });
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function search($text = '')
    {
        return $this->where('name', 'LIKE', "%{$text}%")
                    ->orWhere('cnpj', 'LIKE', "%{$text}%")
                    ->latest();
    }
}
