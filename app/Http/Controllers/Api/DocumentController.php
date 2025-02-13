<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DocumentRecourses;
use App\Models\Documents;
use App\Http\Requests\StoreDocumentsRequest;
use App\Http\Requests\UpdateDocumentsRequest;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $documents = Documents::paginate(30);
         return response()->json(DocumentRecourses::collection($documents));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDocumentsRequest $request)
    {
        $path = $request->file('file')->store('documents', 'public');
        $document = Documents::create([
            'department'=> $request->department,
            'title'=>$request->title,
            'file'=> $path,

        ]);
        return response()->json([
            "success"=>true,
            'message' => 'Файл успешно загружен!',
            'document' => $document,
            'download_url' => asset("storage/{$path}"),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Documents $documents)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDocumentsRequest $request, Documents $documents)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Documents $documents)
    {
        //
    }
}
