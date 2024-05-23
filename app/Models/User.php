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
        return $this->notices()->where('status', 'unread')->get();
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
        return $this->activities()->where('status', 'unread')->get();
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function courses()
    {
        if ($this->isTeacher()) {
            return $this->hasMany(Course::class, 'teacher_id');
        }

        if ($this->isStudent()) {
            return $this->belongsToMany(Course::class);
        }

        return null;
    }

    public function isTeacher()
    {
        return $this->role === 'teacher';
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

    public function isAdmin()
    {
        return $this->role === 'admin';
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
