<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSchedulesRequest;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;

class SchedulesController extends Controller
{
    public function index(){
        $schedules = Schedule::all();
        return response()->json($schedules);
    }

    public function store(StoreSchedulesRequest $request){
        $schedule = Schedule::create($request->validated());
        return response()->json([
            'message' => 'success',
            'data'=>$schedule],
            201);
    }
}
