<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan di database.
     * Sesuaikan dengan nama tabel di database partner kamu jika berbeda.
     */
    protected $table = 'recommendations';

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     */
    protected $fillable = [
        'user_id',
        'major_name',
        'matching_score',
        'description',
    ];

    /**
     * Relasi kebalikannya: Rekomendasi ini milik siapa (User).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
