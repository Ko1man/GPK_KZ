<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index(){
        return view('docs.create');
    }

    public function getDocuments(){
        return view('docs.list');
    }
}
