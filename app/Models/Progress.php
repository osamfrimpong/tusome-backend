<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $table = 'progress';

    protected $fillable = [
        'user_id',
        'question_id',
        'status',
        'score',
        'completed_at'
    ];

    protected $casts = [
        'status' => 'string',
        'score' => 'integer',
        'completed_at' => 'datetime'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'completed_at'
    ];

    protected $appends = [];

    protected $hidden = [];

    protected $with = [];

    /**
     * Define a relationship with the User model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define a relationship with the Question model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
