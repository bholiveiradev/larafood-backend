<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function available($roleId, $text = '')
    {
        $permissions = $this->whereNotIn('id', function ($query) use ($roleId) {
                            $query->select('permission_role.permission_id')
                                ->from('permission_role')
                                ->whereRaw("permission_role.role_id={$roleId}");
                        });

        if(!empty($text)) {
            $permissions->where('name', 'LIKE', "%{$text}%")
                        ->orWhere('description', 'LIKE', "%{$text}%")
                        ->latest();
        }

        return $permissions;
    }

    public function search($text = '')
    {
        return $this->where('name', 'LIKE', "%{$text}%")
                    ->orWhere('description', 'LIKE', "%{$text}%")
                    ->latest();
    }
}
