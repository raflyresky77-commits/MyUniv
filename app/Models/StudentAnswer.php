
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAnswer extends Model
{
    use HasFactory;

    protected $table = 'student_answers';

    public $timestamps = false;

    protected $fillable = [
        'student_id',
        'assessment_id',
        'question_id',
        'question_option_id',
        'score',
        'answered_at',
    ];

    protected function casts(): array
    {
        return [
            'score' => 'integer',
            'answered_at' => 'datetime',
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

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function option()
    {
        return $this->belongsTo(
            QuestionOption::class,
            'question_option_id'
        );
    }
}
