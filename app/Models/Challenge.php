<?php

namespace App\Models;

use App\ChallengeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 
 *
 * @method static \Database\Factories\ChallengeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Challenge newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Challenge newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Challenge query()
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $level
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Challenge whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Challenge whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Challenge whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Challenge whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Challenge whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Challenge whereUpdatedAt($value)
 * @property int $mentor_id
 * @property string $start_date
 * @property string $deadline
 * @property-read \App\Models\Mentor $mentor
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StudentChallenge> $studentChallenges
 * @property-read int|null $student_challenges_count
 * @method static \Illuminate\Database\Eloquent\Builder|Challenge whereDeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Challenge whereMentorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Challenge whereStartDate($value)
 * @mixin \Eloquent
 */
class Challenge extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $casts = [
        'level' => ChallengeEnum::class,
    ];


    public function mentor()
    {
        return $this->belongsTo(Mentor::class);
    }
    public function studentChallenges(): HasMany
    {
        return $this->hasMany(StudentChallenge::class);
    }
}
