<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AssessmentSubtest;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class question extends Model
{
    protected $fillable = [
    'category_id',
    'subtest_id',
    'question_text',
    'type',
    'is_active',
];

public function subtest(): BelongsTo
{
    return $this->belongsTo(
        AssessmentSubtest::class,
        'subtest_id'
    );
}
}

