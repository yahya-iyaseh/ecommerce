<?php

namespace App\Models;

use App\Models\Tag;
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
    protected $hidden  = ['created_at', 'updated_at', 'deleted_at', 'description', 'category', 'cost', 'sku', 'barcode', 'slug', 'image'];
    protected $appends = ['image_url'];
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

    public function cartUsers(){
        return $this->belongsToMany(User::class,'carts', 'product_id', 'user_id', 'id', 'id');
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function tags(){
        return $this->belongsToMany(Tag::class, 'product_tag');
    }
    public function getImageUrlAttribute(){
        if(!$this->image){
            return asset('images/noImage.png');
        }
        if(Str::startsWith($this->image, ['https://', 'http://'])){
            return $this->image;
        }

        return Storage::url($this->image);
    }

    public function getDiscountAttribute(){
        if($this->compare_price){
            return -number_format(( $this->compare_price -  $this->price) / $this->compare_price * 100, 1);
        }
        return 0;
    }
    public function getUrlAttribute(){
        return route('product.show', [$this->category->id, $this->id]);
    }
}
