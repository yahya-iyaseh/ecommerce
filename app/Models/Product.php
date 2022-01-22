<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $with = ['category'];
    protected $fillable = [
        'name', 'slug', 'category_id', 'description', 'additional_info', 'image', 'price',
        'compare_price', 'cost', 'quantity', 'sku', 'barcode', 'status', ' availability '
    ];

    protected static function booted(){
        static::saving(function($product){
            $product->slug = Str::slug($product->name);
        });
        static::forceDeleted(function($product){
            \Storage::delete($product->image);
        });
    }
    public function scopeSearch($query, $value)
    {
        if ($value) {
            $query->where('name', 'like', "%{$value}%");
        }
    }
    public function scopeShowDelete($query, $value)
    {
        if ($value) {
            $query->onlyTrashed();
        }
    }

    public static function availability()
    {
        return [
            'in-stock' => 'In-Stock',
            'out-of-stock' => 'Out-Of-Stock',
            'back-order' => 'Back-Order',
        ];
    }
    public static function getStatus()
    {
        return [
            'active' => 'Active',
            'draft' => 'Draft',
            'archived' => 'Archived',
        ];
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
