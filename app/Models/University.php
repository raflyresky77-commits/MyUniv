<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Ubah dari hasMany menjadi belongsToMany karena melewati tabel perantara university_majors
    public function majors()
    {
        return $this->belongsToMany(Major::class, 'university_majors', 'university_id', 'major_id');
    }
}
