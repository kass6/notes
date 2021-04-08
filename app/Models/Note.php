<?php

namespace App\Models;

use App\Models\Traits\UuidsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * @property string $id
 * @property int $user_id
 * @property boolean $public
 * @property string $content
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property User $sharedToUsers
 * @property NoteSharedToUser $shares
 */
class Note extends Model
{
    use UuidsTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'notes';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'public', 'content', 'created_at', 'updated_at'];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasManyThrough
     */
    public function sharedToUsers(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, NoteSharedToUser::class, 'note_id', 'id', 'id', 'user_id');
    }

    /**
     * @return HasMany
     */
    public function shares(): HasMany
    {
        return $this->hasMany(NoteSharedToUser::class);
    }
}
