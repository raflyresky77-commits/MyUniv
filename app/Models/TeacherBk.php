<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherBk extends Model
{
    protected $table = 'teacher_bk';

    protected $fillable = ['user_id', 'nip', 'phone'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function consultations()
    {
        return $this->hasMany(Consultation::class, 'teacher_id');
    }
}
