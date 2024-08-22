<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuestionAnswer extends Model
{
    use HasFactory;

    protected $table = 'question_answers';

    protected $fillable = [
        'name',
        'phone',
        'survey_id',
        'answers',
        'location',
        'surveyor_id'
    ];

    protected $casts = [
        'answers' => 'array',
        'location' => 'array'
    ];

    /**
     * Get the survey that owns the QuestionAnswer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function survey(): BelongsTo
    {
        return $this->belongsTo(Survey::class, 'survey_id', 'id');
    }
}
