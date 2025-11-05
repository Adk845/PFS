<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name',
    ];

     public function crms()
    {
        return $this->hasMany(Crm::class);
    }

// public function users()
// {
//     return $this->belongsToMany(User::class, 'category_user', 'category_id', 'user_id');
// }


}
