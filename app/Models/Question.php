<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';

    protected $fillable = [
        'survey_id',
        'question',
        'input_id',
        'options',
        'accept',
        'is_multiple',
        'is_matrik',
        'matriks',
        'is_required',
        'ranking',
        'hint',
        'matrik_options',
        'vertical_options',
        'parent_id',
        'need_reason',
        'need_location',
    ];

    protected $casts = [
        'options' => 'json',
        'matriks' => 'json',
        'ranking' => 'json',
        'matrik_options' => 'json',
        'vertical_options' => 'json',
        'need_reason' => 'json',
    ];

    protected $guard = [];

    /**
     * Get the survey that owns the Question
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function survey(): BelongsTo
    {
        return $this->belongsTo(Survey::class, 'survey_id', 'id');
    }

    public function input(): BelongsTo
    {
        return $this->belongsTo(InputGroup::class, 'input_id', 'id');
    }

    public function scopeMultiple(){
        return $this->where('is_multiple', 1);
    }

    public function scopeMatrik(){
        return $this->where('is_matrik', 1);
    }
}
