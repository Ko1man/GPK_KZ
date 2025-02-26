<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Groups;
use Illuminate\Http\Request;

class GroupsController extends Controller
{
    public function store(Request $request){
        $group = $request->validate([
            'name' => 'required|string',
            'department_id' => 'required|exists:departments,id',
        ]);
        Groups::create($group);
        return response()->json(['status'=>true,'data'=>$group],201);
    }
}
