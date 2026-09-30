<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentResult extends Model
{
    use HasFactory;

    protected $table = 'student_assessments'; // Sesuai nama tabel di PRD

    protected $fillable = [
        'user_id',
        'assessment_id',
        'score',
        'summary_result',
        'completed_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
