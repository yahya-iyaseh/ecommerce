<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;
    protected $fillable = ['reviewable_id', 'reviewable_type', 'rating', 'review', 'user_id'];

    public function reviewable(){
        return $this->morphTo();
    }

    public function user(){
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Anonymous'
        ]);
    }
}
