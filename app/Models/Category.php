<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    // protected $with = ['parent', 'childs'];
    protected $guarded = [];
    public function parent(){
       return $this->belongsTo(Category::class, 'parent_id','id' );
    }
    public function childs(){
       return $this->hasMany(Category::class, 'parent_id', 'id');
    }
}
