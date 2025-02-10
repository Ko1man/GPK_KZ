<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ComentStoreRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class ComentController extends Controller
{
    public function store(ComentStoreRequest $request)
    {
        // Создаем новый комментарий и присваиваем его атрибуты
        $comment = Comment::create([
            'user_id' => Auth::id(),  // Получаем ID текущего пользователя
            'comment' => $request->comment,  // Предполагаем, что поле 'content' есть в комментарии
            'news_id' => $request->news_id,
        ]);

        return response()->json([
            'message' => 'Комментарий успешно добавлен!',
            'comment' => $comment
        ], 201);
    }

    public function getComments($newsId)
    {
        // Получаем комментарии для новости с ID = $newsId
        $comments = Comment::where('news_id', $newsId)
            ->with('user')  // Загрузка пользователя, который оставил комментарий
            ->get();

        return response()->json($comments);
    }



    public function delete($commentId)
    {
        $comment = Comment::find($commentId);

        if (!$comment) {
            return response()->json(['message' => 'Комментарий не найден.'], 404);
        }

        // Проверка, что пользователь является автором комментария
        if ($comment->user_id !== Auth::id()) {
            return response()->json(['message' => 'Вы не можете удалить этот комментарий.'], 403);
        }

        // Удаление комментария
        $comment->delete();

        return response()->json(['message' => 'Комментарий успешно удалён.']);
    }


}
