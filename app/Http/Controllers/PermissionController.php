<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of permissions.
     */
    public function index()
    {
        $permissions = Permission::with('roles')
            ->get()
            ->map(function($permission) {
                return [
                    'id' => $permission->id,
                    'name' => $permission->name,
                    'roles' => $permission->roles->map(fn($r) => ['name' => $r->name])->toArray(),
                    'created_at' => $permission->created_at->format('M d, Y'),
                ];
            })
            ->toArray();

        $roles = Role::all();

        return view('backend.pages.permissions.index', compact('permissions', 'roles'));
    }

    /**
     * Show the form for creating a new permission.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created permission in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified permission.
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified permission.
     */
    public function edit(Permission $permission)
    {
        //
    }

    /**
     * Update the specified permission in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        //
    }

    /**
     * Remove the specified permission from storage.
     */
    public function destroy(Permission $permission)
    {
        //
    }
}
