<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'url', 'price', 'description'];

    public function details()
    {
        return $this->hasMany(PlanDetail::class);
    }

    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }

    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    public function search($text = '')
    {
        return $this->where('name', 'LIKE', "%{$text}%")
                    ->orWhere('description', 'LIKE', "%{$text}%")
                    ->latest();
    }
}
