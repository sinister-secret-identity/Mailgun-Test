<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'to', 'subject', 'message', 'mailgun_id', 'mailgun_status'
    ];

    public function scopeCurrentUser($query)
    {
        return $query->where('user_id', '=', Auth::id());
    }

}
