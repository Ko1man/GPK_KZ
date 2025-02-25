<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Groups;
use Illuminate\Http\Request;

class GroupsController extends Controller
{
    public function store(Request $request){
        $group  =Groups::create([
            'name'=>$request->name,
            'department_id'=>$request->department_id,
        ]);
        return response()->json(['status'=>true,'data'=>$group],201);
    }
}
