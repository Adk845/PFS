<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'experience_detail_id',
        'foto',
    ];

    public function experienceDetail()
    {
        return $this->belongsTo(ExperienceDetail::class);
    }
}
