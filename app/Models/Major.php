<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Major extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category_id',
        'university_id',
    ];

    public function universities(): BelongsToMany
    {
        return $this->belongsToMany(
            University::class,
            'university_majors',
            'major_id',
            'university_id'
        )->withPivot('accreditation', 'additional_info');
    }
}