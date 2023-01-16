<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'student_id',
        'upload',
        'score',
        'graded_by'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function conversations()
    {
        return $this->belongsToMany(Conversation::class)->withPivot(["user_id", 'student_id']);;
    }

    public function getGradeAttribute()
    {
        if($this->score >=70){
            return 'A';
        }elseif($this->score >=60){
            return 'B';
        }elseif($this->score >= 50){
            return 'C';
        }elseif($this->score >= 45){
            return 'D';
        }elseif($this->score >=40){
            return 'E';
        }else{
            return 'F';
        }
    }
}
