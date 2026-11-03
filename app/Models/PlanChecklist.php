<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanChecklist extends Model
{
    use HasFactory;

    protected $table = 'plan_checklists';

    protected $fillable = [
        'plan_id',
        'title',
        'is_completed',
        'deadline',
    ];

    protected $casts = [
        'is_completed' => 'boolean',
        'deadline' => 'date',
    ];

    public function plan()
    {
        return $this->belongsTo(EducationPlan::class, 'plan_id');
    }
}
