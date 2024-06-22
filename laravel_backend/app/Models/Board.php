<?php

namespace App\Models;

use App\Models\Ticket;
use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Board extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [];

    public function tickets() : HasMany
    {
        return $this->hasMany(Ticket::class)->orderBy('rank');
    }

    public function project() : BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
