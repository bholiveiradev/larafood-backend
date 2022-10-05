<?php

namespace App\Models;

use App\Tenants\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory, TenantTrait;

    protected $fillable = ['identifier', 'description'];

    public function search($text = '')
    {
        return $this->where('identifier', 'LIKE', "%{$text}%")
                    ->orWhere('description', 'LIKE', "%{$text}%")
                    ->latest();
    }
}
