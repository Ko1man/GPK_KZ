<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view('users.index');
    }
    public function getTeachers(){
        return view('users.teachersTable');
    }
    public function getStudents(){
        return view('users.studentsTable');
    }
}
