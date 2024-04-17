<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('profile.index');
    }

    public function edit()
    {
        return view('profile.edit');
    }

    public function update(Request $request)
    {
        $user = User::find($request->id);
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        if ($request->password) {
            if ($request->password == $request->password_confirmation) {
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
            } else {
                return redirect()->route('profile.edit')->withErrors(['password' => 'Password tidak sesuai'])->withInput();
            }
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        return redirect()->route('profile.index');
    }
}
