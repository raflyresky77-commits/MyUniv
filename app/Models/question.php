<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';

    protected $fillable = [
        'assessment_id',
        'subtest_id',
        'category_id',
        'question_text',
        'type',
        'is_active',
    ];

    // Relasi ke Assessment
    public function assessment()
    {
        return $this->belongsTo(Assessment::class, 'assessment_id');
    }
}
