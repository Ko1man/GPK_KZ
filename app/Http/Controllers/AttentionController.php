<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttentionController extends Controller
{
    public function index(){
        return view('attention.index');
    }
}
