<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InputGroup extends Model
{
    use HasFactory;

    protected $table = 'input_groups';

    protected $fillable = [
        'name',
        'input_id',
        'icon',
        'accept',
        'description',
    ];

    /**
     * Get the input that owns the InputGroup
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function input(): BelongsTo
    {
        return $this->belongsTo(Input::class, 'input_id', 'id');
    }

    /**
     * Get all of the question for the InputGroup
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function question(): HasMany
    {
        return $this->hasMany(Question::class, 'input_id', 'id');
    }
}
