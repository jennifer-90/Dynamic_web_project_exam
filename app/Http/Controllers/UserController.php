<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller

{
    public function index(): View {
        $users = User::all();
        return view('admin.index', compact('users'));
    }



    public function updateUser(Request $request, $id): RedirectResponse {

        $user = User::findOrFail($id);

        // Vérifier si l'utilisateur connecté peut modifier le rôle
        if ($this->canChangeRole($user)) {
            $request->validate([
                'role' => 'required|in:Logged-in-user,Admin,Supervisor',
            ]);

            $user->update([
                'role' => $request->input('role'),
            ]);

            return redirect()->back()->with('success', '🟢 Le rôle a été mis à jour avec succès 🟢!');
        } else {
            return redirect()->back()->with('error', '⛔ Vous n\'avez pas la permission de modifier votre propre rôle ⛔ !');
        }
    }

    private function canChangeRole(User $user): bool
    {
        // Récupérer l'utilisateur connecté
        $loggedInUser = Auth::user();

        return $loggedInUser->id !== $user->id || $loggedInUser->role !== 'Admin';
    }

}
