<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersDashboardController extends Controller
{
    public function dashboard() {
        if(auth()->user()->type == 'admin') {
            return redirect()->route('home');
        }

        $works = User::find(auth()->user()->id)->works();
        return view('users_dashboard.users_dashboard', ['works' => $works]);
    }
}
