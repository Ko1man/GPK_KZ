<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GroupsController extends Controller
{
    public function index(){
        return view('groups.create');
    }

    public function getGroups(){
        return view ('groups.index');
    }
}
