<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentStudent extends Model
{
    use HasFactory;

    protected $table = 'assessment_student'; // Specify the table name

    protected $fillable = [
        'assessment_id',
        'user_id',
        'answers',
        'total_mark',
        'status',
        'completed_at',
        'submitted'
    ];

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
