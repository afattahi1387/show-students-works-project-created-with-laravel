<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAndEditLessonSubjectRequest;
use App\LessonSubject;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function home() {
        $lessons_subjects = LessonSubject::orderBy('id', 'DESC')->get();
        return view('main_views.home', ['lessons_subjects' => $lessons_subjects]);
    }

    public function create_lesson_subject(AddAndEditLessonSubjectRequest $request) {
        LessonSubject::create([
            'subject_name' => $request->subject_name
        ]);

        return redirect()->route('home');
    }
}
