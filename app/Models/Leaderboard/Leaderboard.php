<?php

namespace App\Models\Leaderboard;

use App\Enums\ResetSchedule;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Leaderboard extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'slug',
        'sort_order',
        'reset_schedule',
        'max_entries',
        'created_at',
        'updated_at',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'max_entries' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'reset_schedule' => ResetSchedule::class,
        ];
    }

    public function entries(): HasMany
    {
        return $this->hasMany(LeaderboardEntry::class);
    }
}
