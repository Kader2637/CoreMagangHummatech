<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentTeam extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    protected $fillable = ['student_id', 'hummatask_team_id', 'project_id'];

    /**
     * Get the student that owns the studentTeam
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the hummatask_team that owns the studentTeam
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hummataskTeam(): BelongsTo
    {
        return $this->belongsTo(HummataskTeam::class);
    }

    /**
     * Get the project that owns the studentTeam
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
    public function boards()
    {
        return $this->hasMany(Board::class);
    }
}
