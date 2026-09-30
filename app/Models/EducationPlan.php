<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationPlan extends Model
{
    use HasFactory;

    protected $table = 'education_plans'; // Sesuai PRD[cite: 3]

    protected $fillable = [
        'user_id',
        'title',
        'target_date',
        'status', // pending, in_progress, completed[cite: 3]
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
