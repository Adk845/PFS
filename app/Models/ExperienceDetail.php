<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperienceDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'status',
        'project_no',
        'project_name',
        'client_name',
        'durations',
        'amount',
        'date_project_start',
        'date_project_end',
        'locations',
        'kbli_number',
        'scope_of_work',
    ];

    

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
