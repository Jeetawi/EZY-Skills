<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of roles.
     */
    public function index()
    {
        $roles = Role::withCount(['permissions'])
            ->get()
            ->map(function($role) {
                return [
                    'id' => $role->id,
                    'name' => $role->name,
                    'permissions_count' => $role->permissions_count,
                    'created_at' => $role->created_at->format('M d, Y'),
                ];
            })
            ->toArray();

        $permissions = Permission::all();

        return view('backend.pages.roles.index', compact('roles', 'permissions'));
    }

    /**
     * Show the form for creating a new role.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created role in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified role.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified role.
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified role in storage.
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified role from storage.
     */
    public function destroy(Role $role)
    {
        //
    }
}
