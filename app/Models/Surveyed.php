<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Surveyed extends Model
{
    use HasFactory;

    protected $table = 'surveyeds';

    protected $fillable = [
        'survey_id',
        'surveyor_id',
        'name',
        'phone',
        'coordinate',
        'location',
        'answer',
        'sender',
        'is_verified',
    ];

    /**
     * Get the survey that owns the Surveyed
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function survey(): BelongsTo
    {
        return $this->belongsTo(Survey::class, 'survey_id', 'id');
    }

    public function surveyor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'surveyor_id', 'id');
    }

    public function scopeVerified(){
        return $this->where('is_verified', 1);
    }
}
