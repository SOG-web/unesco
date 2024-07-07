<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Assessment extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'assessment_student');
    }

    public function toArray()
    {
        $data = parent::toArray();

        // Check if the pivot data is loaded
        if ($this->pivot) {
            $data = array_merge($data, [
                'pivot_user_id' => $this->pivot->user_id,
                'pivot_status' => $this->pivot->status,
                'pivot_total_mark' => $this->pivot->total_mark,
                'pivot_created_at' => $this->pivot->created_at,
                'pivot_updated_at' => $this->pivot->updated_at,
            ]);
        }

        return $data;
    }
}
