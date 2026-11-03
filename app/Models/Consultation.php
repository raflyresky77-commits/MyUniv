<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $fillable = [
        'student_id',
        'teacher_id',
        'method',
        'topic',
        'message',
        'scheduled_at',
        'status',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function teacher()
    {
        return $this->belongsTo(TeacherBk::class, 'teacher_id');
    }

    public function responses()
    {
        return $this->hasMany(ConsultationResponse::class, 'consultation_id')
                    ->latest();
    }
}
