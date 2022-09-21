<?php

namespace App\Http\Controllers;

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
}
