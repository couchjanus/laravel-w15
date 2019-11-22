<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\Profile;
use App\Http\Requests\UpdateUserFormRequest;
use App\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // abort_unless(\Gate::allows('user-access'), 403);
        $title = 'Users Management';
        $breadcrumbItem = 'Users';
        $users = User::paginate();
        return view('admin.users.index', compact('title', 'breadcrumbItem', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // abort_unless(\Gate::allows('user-create'), 403);
        $title = 'Add New User';
        $breadcrumbItem = 'Add User';
        $roles = Role::all()->pluck('name', 'id');
        return view('admin.users.create',compact('title', 'breadcrumbItem', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // abort_unless(\Gate::allows('user-create'), 403);
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        $user->roles()->sync($request->input('roles', []));

        $profile = new Profile();
        $user->profile()->save($profile);

        return redirect()->route('admin.users.index')->with('success', 'User Created Successfully!');
    }

    /**
     * Обновление пароля пользователя.
     *
     * @param  Request  $request
     * @return Response
     */
    public function updatePassword(Request $request)
    {
        // Проверка длины пароля...

        $request->user()->fill([
        'password' => Hash::make($request->newPassword)
        ])->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        abort_unless(\Gate::allows('user-show'), 403);
        $user->load('roles');
        return view('admin.users.show', compact('user'))->withUser($user)->withTitle('Users Management');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // abort_unless(\Gate::allows('user-edit'), 403);
        $breadcrumbItem = 'Edit User';
        $title = 'Edit User';
        $roles = Role::all()->pluck('name', 'id');
        $user->load('roles');
        return view('admin.users.edit', compact('title', 'breadcrumbItem', 'roles'))->withUser($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserFormRequest $request, User $user)
    {
        // abort_unless(\Gate::allows('user-edit'), 403);

        $user->update($request->all());
        
        if (!$user->profile) {
            $profile = new Profile();
            $user->profile()->save($profile);
        }
        $user->roles()->sync($request->input('roles', []));
        return redirect(route('admin.users.index'))->with('success', 'User Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // abort_unless(\Gate::allows('user-delete'), 403);

        $user->roles()->detach();
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User Destroed Successfully!');
    }

    public function trashed()
    {
        $users = User::onlyTrashed()->paginate();
        $title = 'Trashed Users';
        $breadcrumbItem = 'Trashed';
        return view('admin.users.trashed', compact('title', 'users', 'breadcrumbItem'));
    }

    public function restore($id)
    {
        User::withTrashed()
            ->where('id', $id)
            ->restore();

        return redirect()->route('admin.users.trashed')->with('success', 'User Restored Successfully!');
    }

    public function userDestroy($id)
    {
        $user = User::withTrashed()
                ->findOrFail($id);
        $user->forceDelete();
        return redirect()->route('admin.users.index')->with('success', 'User Deleted Successfully!');
    }
    
    public function force($id)
    {
        User::trash($id)->forceDelete();
        return redirect()->route('admin.users.index')->with('success', 'User Force Deleted Successfully!');
    }
}
