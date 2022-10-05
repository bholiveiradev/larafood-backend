<?php

namespace App\Models;

use App\Tenants\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, TenantTrait;

    protected $fillable = ['name', 'url', 'description'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function available($productId, $text = '')
    {
        $categories = $this->whereNotIn('id', function ($query) use ($productId) {
                        $query->select('category_product.category_id')
                              ->from('category_product')
                              ->whereRaw("category_product.product_id={$productId}");
                    });

        if(!empty($text)) {
            $categories->where('name', 'LIKE', "%{$text}%")
                     ->orWhere('description', 'LIKE', "%{$text}%")
                     ->latest();
        }

        return $categories;
    }

    public function search($text = '')
    {
        return $this->where('name', 'LIKE', "%{$text}%")
                    ->orWhere('description', 'LIKE', "%{$text}%")
                    ->latest();
    }
}
