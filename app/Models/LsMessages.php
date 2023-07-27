<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LsMessages extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'to_user_id',
        'message',
        'image',
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
