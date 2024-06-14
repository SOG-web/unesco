<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 *
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $title
 * @property string $role
 * @property string|null $profile_pic
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Assessment> $assessments
 * @property-read int|null $assessments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Notice> $notices
 * @property-read int|null $notices_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Progress> $progress
 * @property-read int|null $progress_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Notice> $receivedNotices
 * @property-read int|null $received_notices_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfilePic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = ['id', 'email_verified_at', 'remember_token', 'created_at', 'updated_at'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function unreadNotices()
    {
        return $this->notices()->where('status', 'unread');
    }

    public function setNotification($message, $type, $title)
    {
        Notice::create([
            'user_id' => $this->id,
            'title' => $title,
            'content' => $message,
            'type' => $type,
            'status' => 'unread'
        ]);
    }

    public function notices()
    {
        return $this->hasMany(Notice::class);
    }

    public function receivedNotices()
    {
        return $this->belongsToMany(Notice::class);
    }

    public function unreadActivities()
    {
        return $this->activities()->where('status', 'unread');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function students()
    {
        if ($this->isTeacher()) {
            return $this->belongsToMany(
                User::class, // The model we wish to access
                'course_student', // The name of the pivot table
                'course_id', // Foreign key on the pivot table related to the current model
                'user_id', // Foreign key on the pivot table related to the model we wish to access
                'id', // Local key on the current model
                'id' // Local key on the model we wish to access
            );
        }

        return User::where('role', 'students');
    }

    public function isTeacher()
    {
        return $this->role === 'teacher';
    }

    public function teachers()
    {
        if (!$this->isAdmin()) {
            return null;
        }

        return User::where('role', 'teacher');
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function courses()
    {

        if ($this->isTeacher()) {
            return $this->hasMany(Course::class, 'teacher_id');
        }

        if ($this->isStudent()) {
            return $this->belongsToMany(Course::class, 'course_student');
        }

        return null;
    }

    public function getStudentCourses($studentId)
    {

        $student = User::find($studentId);
        if ($student && $student->isStudent()) {
            return $student->courses()->get();
        }

        return null;
    }

    public function isStudent()
    {
        return $this->role === 'students';
    }

    public function progress()
    {
        return $this->hasMany(Progress::class, 'student_id');
    }

    public function assessments()
    {
        if ($this->isTeacher()) {
            return $this->hasMany(Assessment::class, 'teacher_id');
        }
        return $this->belongsToMany(Assessment::class, 'assessment_student');
    }

    public function assignRole(string $string)
    {
        $this->role = $string;
        $this->save();
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
