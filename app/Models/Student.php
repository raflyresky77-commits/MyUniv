<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    protected $fillable = [
        'user_id',
        'nisn',
        'gender',
        'birth_date',
        'address',
        'phone',
        'school_origin',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
