<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $student_id
 * @property int $course_id
 * @property string $progress
 * @property int $completed
 * @property int $started
 * @property-read \App\Models\Course $course
 * @property-read \App\Models\User $student
 * @method static \Database\Factories\ProgressFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Progress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Progress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Progress query()
 * @method static \Illuminate\Database\Eloquent\Builder|Progress whereCompleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Progress whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Progress whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Progress whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Progress whereProgress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Progress whereStarted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Progress whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Progress whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Progress extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}
