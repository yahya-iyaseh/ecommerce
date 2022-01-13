<?php

namespace App\Models;


use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    // protected $with = ['parent', 'childs'];
    protected $guarded = [];

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
}
