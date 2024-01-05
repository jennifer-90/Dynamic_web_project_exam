<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller

{
    public function index():View{
        $users = User::all();
        return view('admin.index', compact('users'));
    }



    public function updateUser(Request $request): RedirectResponse // POUR ADMIN
    {
        if (auth()->user()->role !== 'Admin') {
            return redirect()->back()->with('error', 'Vous n\'avez pas les autorisations nécessaires.');
        }

        $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255']
        ]);

        $selectedUsers = request('selectedUsers', []);

        foreach ($selectedUsers as $userId) {
            $user = User::findOrFail($userId);

            $user->update([
                'name'  => request('name_' . $user->id),
                'email' => request('email_' . $user->id),
                'role'  => request('role_' . $user->id),
            ]);
        }

        return redirect()->back()->with('success', 'Les profils ont été mis à jour avec succès.');
    }

}
