<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Works extends Model
{
    protected $fillable = [
        'lesson_subject_id', 'user_id', 'presence', 'home_work', 'class_work', 'score', 'description',
        'day', 'month', 'year'
    ];

    public function lesson_subject() {
        return $this->belongsTo(LessonSubject::class);
    }
}
