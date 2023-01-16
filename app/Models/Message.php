<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'content', 'sender_id', 'sender_type'
    ];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }
    public function sender(){
        return $this->morphTo();
    }
}
