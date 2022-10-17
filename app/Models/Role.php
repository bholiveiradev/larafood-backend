<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function search($text = '')
    {
        return $this->where('name', 'LIKE', "%{$text}%")
                    ->orWhere('description', 'LIKE', "%{$text}%")
                    ->latest();
    }
}
