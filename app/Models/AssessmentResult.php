<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentResult extends Model
{
/**
     * Nama tabel yang digunakan di database.
     * Sesuaikan dengan nama tabel yang dibuat oleh partner kamu (misal: 'student_assessments' atau 'assessment_results').
     */
    protected $table = 'assessment_results';

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     */
    protected $fillable = [
        'user_id',
        'assessment_id',
        'score',
        'summary_result',
        'completed_at',
    ];

    /**
     * Relasi kebalikannya: Hasil asesmen ini milik siapa (User).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
