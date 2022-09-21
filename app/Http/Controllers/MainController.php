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
        if(isset($_GET['edit-lesson-subject']) && !empty($_GET['edit-lesson-subject'])) {
            $edit_form_subject_name = LessonSubject::where('id', $_GET['edit-lesson-subject'])->get()[0]['subject_name'];
        } else {
            $edit_form_subject_name = '';
        }
        return view('main_views.home', ['lessons_subjects' => $lessons_subjects, 'edit_form_subject_name' => $edit_form_subject_name]);
    }

    public function create_lesson_subject(AddAndEditLessonSubjectRequest $request) {
        LessonSubject::create([
            'subject_name' => $request->subject_name
        ]);

        return redirect()->route('home');
    }

    public function delete_lesson_subject(LessonSubject $subject) {
        $subject->delete();
        return redirect()->route('home');
    }

    public function update_lesson_subject(LessonSubject $subject, AddAndEditLessonSubjectRequest $request) {
        $subject->update([
            'subject_name' => $request->subject_name
        ]);

        return redirect()->route('home');
    }
}
