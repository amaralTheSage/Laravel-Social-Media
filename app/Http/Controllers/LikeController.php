<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class LikeController extends Controller
{
    public function like(Idea $idea)
    {
        $user = auth()->user();
        $idea->likes()->attach($user);


        return redirect()->route('ideas.show', $idea->id);
        // if (Route::is('ideas.show')) {
        //     return redirect()->route('ideas.show', $idea->id);
        // } else if (Route::is('users.show')) {
        //     return redirect()->route('user.show', $user->id);
        // } else {
        //     return redirect('/');
        // }
    }

    public function unlike(Idea $idea)
    {
        $user = auth()->user();
        $idea->likes()->detach($user);

        return redirect()->route('ideas.show', $idea->id);

        // if (Route::is('ideas.show')) {
        //     return redirect()->route('ideas.show', $idea->id);
        // } else if (Route::is('users.show')) {
        //     return redirect()->route('user.show', $user->id);
        // } else {
        //     return redirect('/');
        // }
    }
}
