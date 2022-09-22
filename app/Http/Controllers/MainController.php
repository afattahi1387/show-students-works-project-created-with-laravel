<?php

namespace App\Http\Controllers;

use App\User;
use App\LessonSubject;
use Illuminate\Http\Request;
use App\Http\Requests\AddAndEditLessonSubjectRequest;
use App\Http\Requests\AddStudentRequest;
use App\Http\Requests\AddWorkReqeust;
use App\Http\Requests\UploadStudentImageRequest;
use App\Works;

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

    public function show_works(User $student) {
        $works = $student->works();
        return view('main_views.show_works', ['student' => $student, 'works' => $works, 'flashed_messages' => self::get_flashed_messages()]);
    }

    public function add_student_work(User $student) {
        $lessons_subjects = LessonSubject::orderBy('id', 'DESC')->get();
        return view('main_views.add_student_work', ['student' => $student, 'lessons_subjects' => $lessons_subjects]);
    }

    public function insert_student_work(User $student, AddWorkReqeust $request) {
        if(isset($request->presence) && !empty($request->presence)) {
            $presence = 1;
        } else {
            $presence = 0;
        }

        if(isset($request->home_work) && !empty($request->home_work)) {
            $home_work = 1;
        } else {
            $home_work = 0;
        }

        if(isset($request->class_work) && !empty($request->class_work)) {
            $class_work = 1;
        } else {
            $class_work = 0;
        }

        if(!empty($request->description)) {
            $description = $request->description;
        } else {
            $description = null;
        }

        Works::create([
            'lesson_subject_id' => $request->lesson_subject_id,
            'user_id' => $student->id,
            'presence' => $presence,
            'home_work' => $home_work,
            'class_work' => $class_work,
            'score' => $request->score,
            'description' => $description,
            'day' => $request->day,
            'month' => $request->month,
            'year' => $request->year
        ]);

        self::set_flash_message('success', 'کار دانش آموز شما با موفقیت اضافه شد.');
        return redirect()->route('show.works', ['student' => $student->id]);
    }

    public function add_student() {
        return view('main_views.add_student');
    }

    public function insert_student(AddStudentRequest $request) {
        $name = $request->name;
        $username = $request->username;
        $password = bcrypt($request->password);
        $new_student = User::create([
            'name' => $name,
            'username' => $username,
            'password' => $password,
            'image' => ''
        ]);

        return redirect()->route('upload.student.image.form', ['student' => $new_student->id]);
    }

    public function upload_student_image_form(User $student) {
        return view('main_views.upload_student_image', ['student' => $student]);
    }

    public function upload_student_image_post(User $student, UploadStudentImageRequest $request) {
        $imagePath = $request->image->path();
        $imageName = $request->image->getClientOriginalName();
        $imageNewName = $student->id . '_' . $imageName;
        move_uploaded_file($imagePath, 'images/students_images/' . $imageName);
        rename('images/students_images/' . $imageName, 'images/students_images/' . $imageNewName);
        $student->update([
            'image' => $imageNewName
        ]);

        self::set_flash_message('success', 'دانش آموز شما با موفقیت اضافه شد.');
        return redirect()->route('dashboard.students');
    }
}
