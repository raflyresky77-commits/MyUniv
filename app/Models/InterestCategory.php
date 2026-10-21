
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterestCategory extends Model
{
    protected $table = 'interest_categories';

    protected $fillable = [
        'name',
        'description',
        'color_code',
    ];

    public function assessmentResults()
    {
        return $this->hasMany(
            AssessmentResult::class,
            'category_id'
        );
    }
}
