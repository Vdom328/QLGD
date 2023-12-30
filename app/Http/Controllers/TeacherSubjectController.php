<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherSubjectController extends Controller
{
    public function index()
    {
        return view('pages.teacher-subject.index');
    }
}
