<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function follow(User $user)
    {
        $follower = auth()->user(); //gets the user currently logged in
        $follower->followings()->attach($user);

        return redirect()->route('users.show', $user->id);
    }

    public function unfollow(User $user)
    {
        $follower = auth()->user(); //gets the user currently logged in
        $follower->followings()->detach($user);

        return redirect()->route('users.show', $user->id);
    }
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('pages.profile', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        Gate::authorize('update', $user);
        return view('pages.edit-profile', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user, UpdateUserRequest $request)
    {
        Gate::authorize('update', $user);

        $validated = $request->validated();

        if ($request->has('image-input')) {
            $imagePath = $request->file('image-input')->store('profile', 'public');
            $validated['image-input'] = $imagePath;

            Storage::disk('public')->delete($user->image);
        }

        $user->update(['username' => $validated['username-input'], 'image' => ($validated['image-input'] ?? $user->image), 'bio' => $validated['bio-input']]);

        return redirect()->route('users.show', $user);
    }



    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(string $id)
    // {
    //     //
    // }
}
