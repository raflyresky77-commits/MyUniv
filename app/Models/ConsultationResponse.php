<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultationResponse extends Model
{
    protected $fillable = [
        'consultation_id',
        'teacher_id',
        'responses',
        'recommendation',
    ];

    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }

    public function teacher()
    {
        return $this->belongsTo(TeacherBk::class, 'teacher_id');
    }
}
