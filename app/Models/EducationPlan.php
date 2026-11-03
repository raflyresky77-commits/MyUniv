<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationPlan extends Model
{
    use HasFactory;

    protected $table = 'education_plans';

    protected $fillable = [
        'student_id',
        'title',
        'description',
        'target_major_id',
        'alternative_major_id',
        'target_university_id',
        'alternative_university_id',
        'admission_path',
        'career',
        'status',
        'notes',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function targetMajor()
    {
        return $this->belongsTo(Major::class, 'target_major_id');
    }

    public function alternativeMajor()
    {
        return $this->belongsTo(Major::class, 'alternative_major_id');
    }

    public function targetUniversity()
    {
        return $this->belongsTo(University::class, 'target_university_id');
    }

    public function alternativeUniversity()
    {
        return $this->belongsTo(University::class, 'alternative_university_id');
    }

    public function checklists()
    {
        return $this->hasMany(PlanChecklist::class, 'plan_id');
    }
}
