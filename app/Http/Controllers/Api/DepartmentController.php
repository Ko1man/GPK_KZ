<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepartmentRequest;
use App\Models\Department;
use App\Models\Departments;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Departments::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(StoreDepartmentRequest $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartmentRequest $request)
    {
        $departments = Departments::create($request->validated());
        return response()->json(['message' => 'Department created successfully.', 'data'=>$departments], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Departments $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Departments $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Departments $department)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Departments $department)
    {
        //
    }
}
