<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RandomUser;

class RandomUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = RandomUser::orderBy('last_updated', 'desc')->paginate(10);
        return view('dashboard', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add()
    {
        return view('random-users.ADD', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(Request $request, RandomUser $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:random_users',
            'gender' => 'required|string',
            'phone' => 'required|string',
        ]);

        $user::create($validated);

        return redirect()->route('dashboard')->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RandomUser $user)
    {
        return view('random-users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RandomUser $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'gender' => 'required|string',
            'phone' => 'required|string',
        ]);

        $user->update($validated);

        return redirect()->route('dashboard')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RandomUser $user)
    {
        $user->delete();

        return redirect()->route('dashboard')->with('success', 'User deleted successfully');
    }
}
