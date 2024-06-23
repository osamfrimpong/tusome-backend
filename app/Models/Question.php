<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'questions';

    protected $fillable = [
        'user_id',
        'category_id',
        'subject',
        'year',
        'question_content',
        'is_active',
        'published_at',
    ];

    protected $casts = [
        'question_content' => 'array',
        'is_active' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'published_at',
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
}
