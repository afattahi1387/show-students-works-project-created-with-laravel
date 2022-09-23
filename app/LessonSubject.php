<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LessonSubject extends Model
{
    protected $fillable = ['subject_name'];

    public function count_works() {
        return $this->hasMany(Works::class)->count();
    }
}
