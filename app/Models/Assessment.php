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
 * @property int $course_id
 * @property string $title
 * @property string $status
 * @property string $type
 * @property int $show_result
 * @property int $no_of_questions
 * @property int|null $mark_per_questions
 * @property string $questions
 * @property-read \App\Models\Course $course
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $students
 * @property-read int|null $students_count
 * @method static \Database\Factories\AssessmentFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Assessment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Assessment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Assessment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Assessment whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assessment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assessment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assessment whereMarkPerQuestions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assessment whereNoOfQuestions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assessment whereQuestions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assessment whereShowResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assessment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assessment whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assessment whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assessment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
