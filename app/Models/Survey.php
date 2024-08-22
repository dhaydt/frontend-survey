<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Survey extends Model
{
    use HasFactory;

    protected $table = 'surveys';

    protected $fillable = [
        'name',
        'description',
        'expire_at',
        'is_active',
        'surveys_id',
    ];

    protected $guard = [];

    /**
     * Get all of the questions for the Survey
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class, 'survey_id', 'id');
    }

    public function surveyed(): HasMany
    {
        return $this->hasMany(Surveyed::class, 'survey_id', 'id');
    }

    public function responder(): HasMany
    {
        return $this->hasMany(QuestionAnswer::class, 'survey_id', 'id');
    }

    public function scopeActive()
    {
        return $this->where('is_active', 1);
    }

    public function scopeExpire()
    {
        return $this->where('expire_at', '<', Carbon::now());
    }
}
