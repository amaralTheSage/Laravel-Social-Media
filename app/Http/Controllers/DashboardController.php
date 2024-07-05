<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmationEmail;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $ideas  =  Idea::orderByDesc('created_at');

        if ($request->has('search-input')) {
            $ideas = $ideas->where('content', 'like', '%' .  $request->get('search-input') . '%');
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
        if (auth()->id() !== $idea->user_id) {
            abort(404);
        }

        Idea::destroy($idea->id);

        return redirect('/')->with('sucess', 'Idea deleted succesfully!');
    }

    public function edit(Idea $idea)
    {

        if (auth()->id() !== $idea->user_id) {
            abort(404);
        }

        $editing = true;
        return view('pages/show-one', compact('ideas', 'editing'));
    }


    public function update(Idea $idea)
    {
        if (auth()->id() !== $idea->user_id) {
            abort(404);
        }

        $validated = request()->validate(['contentBox' => 'required|max:300']);

        $idea->update($validated);

        return redirect()->route('ideas.show', ['idea' => $idea->id]);
    }
}
