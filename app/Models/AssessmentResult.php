
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentResult extends Model
{
    use HasFactory;

    protected $table = 'assessment_results';

    protected $fillable = [
        'student_id',
        'assessment_id',
        'category_id',
        'score',
        'percentage',
    ];

    protected function casts(): array
    {
        return [
            'score' => 'integer',
            'percentage' => 'decimal:2',
        ];
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function assessment()
    {
        return $this->belongsTo(Assessment::class, 'assessment_id');
    }

    public function category()
    {
        return $this->belongsTo(
            InterestCategory::class,
            'category_id'
        );
    }
}
