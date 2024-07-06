<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $users = Auth::user()->followings()->pluck('user_id'); // grabs the id of all the people the user is following


        $ideas = Idea::whereIn('user_id', $users)->orderByDesc('created_at');

        if ($request->has('search-input')) {
            $ideas = $ideas->where('content', 'like', '%' .  $request->get('search-input') . '%');
        }

        return view('pages.feed', [
            'ideas' => $ideas->paginate(5), 'commentable' => false
        ]);
    }
}
