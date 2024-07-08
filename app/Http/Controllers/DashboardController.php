<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmationEmail;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use PHPUnit\Framework\MockObject\Rule\Parameters;

class DashboardController extends Controller
{




    // $idea = new Idea(['content' => 'likes']);

    // Lembrando: => é usado pra assinalar chaves-valores
    // Portanto ['ideas' => Idea::all()] é a mesma coisa que
    // {ideas: Idea::all()}

    public function index(Request $request)
    {
        // This with('user') is eager loading. It makes it so each user queried from the DB is only queried once.
        // The 'comments.user' makes it so same users dont get queried multiple times for different comments.
        // These problems were being shown in the Laravel Debug Bar

        // New eager loading method being done in the Idea model ($with)
        // Idea::without('user') would disable eager loading.

        // $ideas  =  Idea::with('user', 'comments.user')->orderByDesc('created_at');
        $ideas  =  Idea::withCount('likes')->orderByDesc('created_at');

        if ($request->has('search-input')) {
            $ideas = $ideas->where('content', 'like', '%' .  $request->get('search-input') . '%');
        }

        // Who-to-follow-logic
        $whoToFollow = User::all();

        if (Auth::user()) {
            $followedByUser = Auth::user()->followings()->pluck('user_id'); // grabs the id of all the people the user is following
            $followedByUser = [...$followedByUser, auth()->id()];
            $whoToFollow = User::whereNotIn('id', $followedByUser)->get();
        }


        return view('pages.feed', [
            'ideas' => $ideas->paginate(5), 'commentable' => false
        ]);
    }

    public function show(Idea $idea)
    {

        return view('pages/show-one', ['idea' => $idea, 'commentable' => true]);
    }


    public function store(Request $request)
    {
        $validated = request()->validate(['contentBox' => 'required|max:300']);

        $validated['user_id'] = auth()->id();

        Idea::create(['user_id' => $validated['user_id'], 'content' => $validated['contentBox']]);

        return redirect('/')->with('sucess', 'The idea was created succesfully!');
    }

    public function destroy(Idea $idea)
    {
        Gate::authorize('delete', $idea);
        Idea::destroy($idea->id);
        return redirect('/')->with('sucess', 'Idea deleted succesfully!');
    }

    public function edit(Idea $idea)
    {
        Gate::authorize('update', $idea);
        $editing = true;
        $commentable = false;

        return view('pages/show-one', compact('idea', 'editing', 'commentable'));
    }


    public function update(Idea $idea)
    {
        Gate::authorize('update', $idea);
        $validated = request()->validate(['contentBox' => 'required|max:300']);
        $idea->update($validated);

        return redirect()->route('ideas.show', ['idea' => $idea->id]);
    }
}
