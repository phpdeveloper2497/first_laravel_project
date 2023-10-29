<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $comment = Comment::create([
            'body' => $request->body,
            'post_id' => $request->post_id,
            'user_id' => auth()->id(),   // 'user_id' => auth()->id(),  foydalanuvchilar ko'p  bo'lganda va registrdan o'tganda shunday topiladi foydalanuvchi
        ]);


                    //2-usul
//        $post = Post::find($request->post_id);
//        $post->comments()->create([
//            'body' =>$request->body,
//            'user_id' =>$request->user_id
//        ]);

        return redirect()->back();
    }
}
