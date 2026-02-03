<?php

namespace App\Http\Controllers;

use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

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
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
                'role' => ['required', 'exists:roles,name'],
            ]);

            DB::beginTransaction();

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            $user->assignRole($validated['role']);

            DB::commit();

            // Success flash message
            flash()->success('User created successfully!', [
                'timeout' => 10000,
                'position' => 'bottom-right',
                'closeButton' => true,
            ]);

            return redirect()->route('users.index');

        } catch (\Exception $e) {
            DB::rollBack();

            // Error flash message
            flash()->error('Failed to create user: ' . $e->getMessage(), [
                'timeout' => 10000,
                'position' => 'bottom-right',
                'closeButton' => true,
            ]);

            return redirect()->back()->withInput();
        }
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        try {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
                'password' => ['nullable', 'string', 'min:8'],
                'role' => ['required', 'exists:roles,name'],
            ]);

            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
            ]);

            if (!empty($validated['password'])) {
                $user->update(['password' => bcrypt($validated['password'])]);
            }

            $user->syncRoles([$validated['role']]);

            // Success flash message
            flash()->success('User updated successfully!', [
                'timeout' => 10000,
                'position' => 'bottom-right',
                'closeButton' => true,
            ]);

            return redirect()->route('users.index');

        } catch (\Exception $e) {
            // Error flash message
            flash()->error('Failed to update user: ' . $e->getMessage(), [
                'timeout' => 10000,
                'position' => 'bottom-right',
                'closeButton' => true,
            ]);

            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();

            // Success flash message
            flash()->success('User deleted successfully!', [
                'timeout' => 10000,
                'position' => 'bottom-right',
                'closeButton' => true,
            ]);

            return redirect()->route('users.index');

        } catch (\Exception $e) {
            // Error flash message
            flash()->error('Failed to delete user: ' . $e->getMessage(), [
                'timeout' => 10000,
                'position' => 'bottom-right',
                'closeButton' => true,
            ]);

            return redirect()->back();
        }
    }
}
