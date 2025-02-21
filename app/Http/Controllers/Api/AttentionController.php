<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\storeAttentionRequest;
use App\Http\Requests\updateAttentionRequest;
use App\Models\Attention;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttentionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attentions = Attention::with('user', 'group')->get();
        return response()->json(['success'=>true,'data'=>$attentions], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeAttentionRequest $request)
    {
        $attention = Attention::create([
            'user_id'   => $request->user_id,
            'group_id'  => $request->group_id,
            'attention' => $request->attention,
            'date'      => $request->date,
        ]);
        return response()->json(['status' => 'success', 'data'=>$attention], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Attention $attention)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateAttentionRequest $request, Attention $attention)
    {
            // Сохраняем всю старую запись в лог перед обновлением
            DB::table('attention_log')->insert([
                'attention_id' => $attention->id,
                'old_user_id' => $attention->user_id,
                'old_group_id' => $attention->group_id,
                'old_date' => $attention->date,
                'old_attention' => $attention->attention,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Обновляем только переданные данные
            $attention->update($request->only(['attention', 'date']));

            return response()->json(['status' => 'success', 'data' => $attention], 200);
        }


        /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attention $attention)
    {
        //
    }
}
