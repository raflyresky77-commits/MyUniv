<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    use HasFactory;

    protected $table = 'recommendations'; // Atau relasi langsung ke tabel majors / student recommendations

    protected $fillable = [
        'user_id',
        'major_name',
        'matching_score',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
