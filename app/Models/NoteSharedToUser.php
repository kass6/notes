<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property int $id
 * @property int $user_id
 * @property string $note_id
 */
class NoteSharedToUser extends Pivot
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'notes_shared_to_users';

    public $timestamps = false;

}
