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
 * @property string $title
 * @property string $content
 * @property string $status
 * @property string $type
 * @property int $user_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $recipients
 * @property-read int|null $recipients_count
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\NoticeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Notice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notice query()
 * @method static \Illuminate\Database\Eloquent\Builder|Notice whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notice whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notice whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notice whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notice whereUserId($value)
 * @mixin \Eloquent
 */
class Notice extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recipients()
    {
        return $this->belongsToMany(User::class);
    }
}
