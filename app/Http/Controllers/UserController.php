<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Models\Region;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $datatable)
    {
        return $datatable->render("pages.user.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $regions = Region::all();
        return view('pages.user.create', compact('roles', 'regions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role_id' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'region_id' => 'required'
        ]);

        $request['password'] = Hash::make($request->password);
        User::create($request->only('name', 'email', 'role_id', 'password', 'region_id'));

        return redirect()->route('user.index')->with('alert', [
            'type' => 'success',
            'message' => 'Berhasil Menambahkan Pengguna',
            'title' => 'Berhasil'
        ]);
    }

    /**
     * Change password for specific user.
     */
    public function changePassword(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request->password) {
            $request->validate([
                'password' => 'required|confirmed',
                'password_confirmation' => 'required'
            ]);

            $user->update(['password' => Hash::make($request->password)]);
            return redirect()->route('user.index')->with('alert', [
                'type' => 'success',
                'message' => 'Berhasil Mengganti Sandi Pengguna',
                'title' => 'Berhasil'
            ]);
        }

        return view('pages.user.change-password', compact('user'));
    }

    /**
     * Force login for specific user.
     */
    public function forceLogin(Request $request, $id)
    {
        $user = User::findOrFail($id);
        Auth::login($user);
        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $regions = Region::all();
        return view('pages.user.create', compact('user', 'regions', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role_id' => 'required',
            'region_id' => 'required'
        ]);

        $user->update($request->only('name', 'email', 'role_id', 'region_id'));

        return redirect()->route('user.index')->with('alert', [
            'type' => 'success',
            'message' => 'Berhasil Memperbarui Pengguna',
            'title' => 'Berhasil'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
    }
}
