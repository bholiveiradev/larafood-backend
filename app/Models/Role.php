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

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function available($userId, $text = '')
    {
        $roles = $this->whereNotIn('id', function ($query) use ($userId) {
            $query->select('role_user.role_id')
                ->from('role_user')
                ->whereRaw("role_user.user_id={$userId}");
        });

        if(!empty($text)) {
            $roles->where('name', 'LIKE', "%{$text}%")
                ->orWhere('description', 'LIKE', "%{$text}%")
                ->latest();
        }

        return $roles;
    }

    public function search($text = '')
    {
        return $this->where('name', 'LIKE', "%{$text}%")
                    ->orWhere('description', 'LIKE', "%{$text}%")
                    ->latest();
    }
}
