<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function plans()
    {
        return $this->belongsToMany(Plan::class);
    }

    public function available($planId, $text = '')
    {
        $profiles = $this->whereNotIn('id', function ($query) use ($planId) {
                        $query->select('plan_profile.profile_id')
                              ->from('plan_profile')
                              ->whereRaw("plan_profile.plan_id={$planId}");
                    });

        if(!empty($text)) {
            $profiles->where('name', 'LIKE', "%{$text}%")
                     ->orWhere('description', 'LIKE', "%{$text}%")
                     ->latest();
        }

        return $profiles;
    }

    public function search($text = '')
    {
        return $this->where('name', 'LIKE', "%{$text}%")
                    ->orWhere('description', 'LIKE', "%{$text}%")
                    ->latest();
    }
}
