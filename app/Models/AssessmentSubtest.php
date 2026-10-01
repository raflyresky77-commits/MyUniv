<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AssessmentSubtest extends Model
{
    protected $fillable = [
        'assessment_type_id',
        'name',
        'code',
        'description',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function assessmentType(): BelongsTo
    {
        return $this->belongsTo(
            AssessmentType::class
        );
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class, 'subtest_id');
    }
}