<?php

namespace App\Models;


use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    // protected $with = ['parent', 'childs'];
    protected $guarded = [];
    protected static function booted(){
        static::forceDeleted(function($category){
                \Storage::delete($category->image);
        });
        static::saving(function($category){
            $category->slug = Str::slug($category->name);
        });
    }
    public function scopeSearch($query, $value)
    {
        if ($value) {
            $query->where('name','like', "%{$value}%");
        }
    }
    public function scopeShowDelete($query, $value){
        if($value){
            $query->onlyTrashed();
        }
    }
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }
    public function childs()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
    public function products(){
        return $this->hasMany(Product::class);
    }

    // Accessors: get{Name}Attribute
    // $category->image_url
    public function getImageUrlAttribute(){
        if(! $this->image){
            return asset('images/noImage.png');
        }
        if(Str::startsWith($this->image, ['https://', 'http://'])){
            return $this->image;
        }

        return Storage::url($this->image);
    }

    // public function getNameAttribute($value){
    //     return strtoupper($value);
    // }

    public function getNameAttribute($value){
        return Str::title($value);
    }

    // Mutators: set{Name}Attribute
        // public function setNameAttribute($value){
        //     $this->attributes['name'] = Str::title($value);
        // }
}
