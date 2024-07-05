<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Idea;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // public function index(Idea $idea)
    // {
    //     $commentList = Comment::where('idea_id', $idea->id)->get();

    //     return redirect('/');
    // }


    public function store(Request $request, Idea $idea)
    {
        request()->validate(['comment-box' => 'required|max:300']);

        $comment = new Comment(['user_id' => auth()->id(), 'idea_id' => $idea->id, 'content' => request('comment-box')]);
        $comment->save();

        return redirect()->route('ideas.show', $idea->id)->with('sucess', 'The comment was created succesfully!');
    }
}
