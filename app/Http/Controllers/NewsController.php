<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
   public function index(){
       return view('news.inde');
   }

   public function show($id, News $news){
       return view('news.show', compact('id', 'news'));
   }

   public function create(){
       return view('news.create');
   }
}
