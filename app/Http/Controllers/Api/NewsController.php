<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\News;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return News::with('author')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsRequest $request)
    {
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Сохранение изображения
            $imagePath = $request->file('image')->store('news_images', 'public');
        } else {
            return response()->json(['error' => 'Ошибка загрузки изображения'], 400);
        }

        // Создание новости
        $news = new News();
        $news->title = $request->input('title');
        $news->short_description = $request->input('short_description');
        $news->full_description = $request->input('full_description');
        $news->author_id = $request->input('author_id');
        $news->image = $imagePath; // Сохраняем путь к изображению
        $news->save();

        // Возвращаем успешный ответ
        return response()->json([
            'success' => 'Новость успешно создана!',
            'news' => $news
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {

        $news = $news->load('author', 'comment');
        if (!$news) {
            abort(404);
        }

        return response()->json($news, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsRequest $request, News $news)
    {
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $news->image = $imagePath;  // Сохраняем путь к изображению
        }

        // Обновляем остальные данные новости
        $news->update($request->except('image'));  // И исключаем поле image, так как оно уже обновляется

        return response()->json([
            'success' => true,
            'message' => 'Новость обновлена успешно!',
            'data' => $news]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        $news->delete();
        return response()->json(['message' => 'Deleted Successfully'], 200);
    }

}
