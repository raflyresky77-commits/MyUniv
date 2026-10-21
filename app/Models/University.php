<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class University extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function majors(): BelongsToMany
    {
        return $this->belongsToMany(
            Major::class,
            'university_majors',
            'university_id',
            'major_id'
        )->withPivot('accreditation', 'additional_info');
    }
}
