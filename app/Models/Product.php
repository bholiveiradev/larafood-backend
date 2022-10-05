<?php

namespace App\Models;

use App\Tenants\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, TenantTrait;

    protected $fillable = ['title', 'url', 'price', 'image', 'description' ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function search($text = '')
    {
        return $this->where('title', 'LIKE', "%{$text}%")
                    ->orWhere('description', 'LIKE', "%{$text}%")
                    ->latest();
    }
}
