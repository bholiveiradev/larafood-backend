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

    public function available($profileId, $text = '')
    {
        $permissions = $this->whereNotIn('id', function ($query) use ($profileId) {
                            $query->select('permission_profile.permission_id')
                                ->from('permission_profile')
                                ->whereRaw("permission_profile.profile_id={$profileId}");
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
