<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationPlan extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan di database.
     * Sesuai dengan spesifikasi PRD untuk perencanaan studi siswa.
     */
    protected $table = 'education_plans';

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     */
    protected $fillable = [
        'user_id',
        'title',
        'target_date',
        'status', // pending, in_progress, completed
        'notes',
    ];

    /**
     * Relasi kebalikannya: Rencana pendidikan ini milik siapa (User).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
