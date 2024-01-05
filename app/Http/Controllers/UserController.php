<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller

{
    public function index(): View {
        $users = User::all();
        return view('admin.index', compact('users'));
    }



    public function updateUser(Request $request, $id): RedirectResponse {

        $user = User::findOrFail($id);

        $request->validate([
            'role' => 'required|in:Logged-in-user,Admin,Supervisor',
        ]);

        $user->update([
            'role' => $request->input('role'),
        ]);

        return redirect()->back()->with('success', 'Le rôle a été mis à jour avec succès.');
    }

    /*
     *   public function updateUser(ProfileUpdateRequest $request): RedirectResponse {

        $usersData = $request->input('users', []);

        foreach ($usersData as $userId => $userData) {
            $user = User::findOrFail($userId);

            $user->name = $userData['name'];
            $user->email = $userData['email'];
            $user->role = $userData['role'];
            $user->save();
        }

        return redirect()->back()->with('success', 'Les profils ont été mis à jour avec succès.');
    }
     * */


}
