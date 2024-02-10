<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Question extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $casts = [
        'draft' => 'bool',
    ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * @return HasMany<Vote>
     */
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    public function likes(): Attribute
    {
        return new Attribute(get: fn () => $this->votes()->sum('like'));
    }

    public function unlikes(): Attribute
    {
        return new Attribute(get: fn () => $this->votes()->sum('unlike'));
    }
}
