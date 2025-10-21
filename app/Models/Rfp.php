<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rfp extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'title',
        'description',
        'status',
        'attachment'
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    public function experienceDetail()
    {
        return $this->hasOne(ExperienceDetail::class);
    }
}
