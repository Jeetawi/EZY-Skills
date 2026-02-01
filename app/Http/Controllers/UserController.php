<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index()
    {
        $users = User::with('roles')
            ->latest()
            ->get()
            ->map(function($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->roles->first()?->name ?? 'No role',
                    'status' => $user->email_verified_at ? 'Active' : 'Pending',
                    'created_at' => $user->created_at->format('M d, Y'),
                ];
            })
            ->toArray();

        $roles = Role::all();

        return view('backend.pages.users.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
