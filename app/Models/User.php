<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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

    public function isStudent()
    {
        return $this->role === 'student';
    }

    public function progress()
    {
        return $this->hasMany(Progress::class, 'student_id');
    }

    public function assessments()
    {
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
