<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAndEditLessonSubjectRequest;
use App\LessonSubject;
use App\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function get_flashed_messages() {
        $flashed_messages = [];
        foreach(session()->all() as $session_name => $session_value) {
            if(substr($session_name, 0, 6) == 'flash_') {
                $flashed_messages[substr($session_name, 6)] = $session_value;
                session()->forget($session_name);
            }
        }

        return $flashed_messages;
    }

    public function set_flash_message($type, $message) {
        session()->put('flash_' . $type, $message);
    }

    public function home() {
        $lessons_subjects = LessonSubject::orderBy('id', 'DESC')->get();
        if(isset($_GET['edit-lesson-subject']) && !empty($_GET['edit-lesson-subject'])) {
            $edit_form_subject_name = LessonSubject::where('id', $_GET['edit-lesson-subject'])->get()[0]['subject_name'];
        } else {
            $edit_form_subject_name = '';
        }
        return view('main_views.home', ['lessons_subjects' => $lessons_subjects, 'edit_form_subject_name' => $edit_form_subject_name, 'flashed_messages' => self::get_flashed_messages()]);
    }

    public function create_lesson_subject(AddAndEditLessonSubjectRequest $request) {
        LessonSubject::create([
            'subject_name' => $request->subject_name
        ]);

        self::set_flash_message('success', 'موضوع درس شما با موفقیت اضافه شد.');
        return redirect()->route('home');
    }

    public function delete_lesson_subject(LessonSubject $subject) {
        $subject->delete();
        self::set_flash_message('success', 'موضوع درس شما با موفقیت حذف شد.');
        return redirect()->route('home');
    }

    public function update_lesson_subject(LessonSubject $subject, AddAndEditLessonSubjectRequest $request) {
        $old_subject_name = $subject->subject_name;
        $subject->update([
            'subject_name' => $request->subject_name
        ]);

        self::set_flash_message('success', 'موضوع درس مورد نظر شما با نام ' . $old_subject_name . ' با موفقیت ویرایش و تبدیل به ' . $request->subject_name . ' شد.');
        return redirect()->route('home');
    }

    public function students() {
        $students = User::where('type', 'user')->orderBy('id', 'DESC')->get();
        return view('main_views.students', ['students' => $students, 'flashed_messages' => self::get_flashed_messages()]);
    }
}
