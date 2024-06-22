<?php

namespace App\Models;

use App\Models\User;
use App\Models\Board;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ticket extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [];

    public function board() : BelongsTo
    {
        return $this->belongsTo(Board::class);
    }

    public function creator() : BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function members() : BelongsToMany
    {
        return $this->belongsToMany(User::class, 'ticket_user', 'ticket_id', 'user_id');
    }
}
