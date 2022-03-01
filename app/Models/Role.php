<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'permissions'];

    protected $casts = [
        'permissions' => 'array'
    ];

    public function has($permission){
        if(! $this->permissions){
            return [];
        }

        return in_array($permission, $this->permissions);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
