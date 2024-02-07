<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'all_day_flag', 'url'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'all_day_flag' => 'boolean',
    ];
    /**
     * Undocumented function
     *
     * @param Builder $query
     * @param string $startDate
     * @param string $endDate
     * @return void
     */
    public function scopeDateRange(Builder $query, string $startDate, string $endDate): Builder
    {
        return $query->where('start_time', '>=', $startDate)
                     ->where('end_time', '<=', $endDate);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function eventMembers(): HasMany
    {
        return $this->hasMany(EventMember::class);
    }
}
