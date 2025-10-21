<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'proposal_id',
        'file_name',
        'file_path',
        'uploaded_by',
        'notes',
    ];

    public function proposal()
{
    return $this->belongsTo(Proposal::class);
}

}
