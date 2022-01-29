<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;
    // set the table primary key name
    protected $primaryKey = 'user_id';
    protected $fillable = ['user_id', 'first_name', 'last_name', 'gender', 'birth_date', 'address', 'city', 'country_code', 'timezone' ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
