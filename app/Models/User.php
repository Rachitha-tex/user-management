<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable=['id_number','dob','age','name','pnumber','address','religion','nationality','user_img'];

    protected $table='users';

    public function religions(){
        return $this->belongsTo(Religion::class,'rel_id');
    }
    public function nationalities(){
        return $this->belongsTo(Nationality::class);
    }
}
