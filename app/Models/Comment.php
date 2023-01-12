<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'content', 'project_id', 'commentable_type', 'commentable_id'
    ];

    use HasFactory;

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function commentable()
    {
        return $this->morphTo();
    }
}
