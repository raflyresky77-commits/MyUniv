<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    protected $table = 'assessments';

    // Beritahu Laravel bahwa ID di database bertipe angka (bigint) dan auto-increment
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'title',
        'category',
        'description',
        'is_active',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class, 'assessment_id');
    }
}
