<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */

    /*
     *     public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }*/

    public function update(Request $request): RedirectResponse {
        $user = Auth::user();

        $validatedData = $request->validate([
            'name'  => [
                'required',
                'string',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
        ], [
            'name.required'  => 'Le champ nom est obligatoire.',
            'name.string'    => 'Le champ nom doit être une chaîne de caractères.',
            'name.max'       => 'Le champ nom ne doit pas dépasser 255 caractères.',
            'name.unique'    => 'Ce nom est déjà utilisé. Veuillez en choisir un autre.',
            'email.required' => 'Le champ adresse e-mail est obligatoire.',
            'email.email'    => 'L\'adresse e-mail doit être une adresse e-mail valide.',
            'email.max'      => 'L\'adresse e-mail ne doit pas dépasser 255 caractères.',
            'email.unique'   => 'L\'adresse e-mail est déjà utilisée par un autre utilisateur. Veuillez en choisir une autre.',
        ]);

        $user->fill($validatedData);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }


    public function exportJson(): \Illuminate\Http\Response  {
        $user = Auth::user();

        if ($user) {
            unset($user->password);
            unset($user->email_verified_at);
            unset($user->remember_token);
            unset($user->created_at);
            unset($user->updated_at);
            $user->user_status = ($user->user_status == 1)? 'actif': 'non actif';
        }

        $jsonContent = json_encode($user, JSON_PRETTY_PRINT);

        return Response::make($jsonContent, 200, ['content-Type'        => 'application/json',
                                                  'Content-Disposition' => 'attachment; filename=user_' . $user->id . '_' . time() . '.json']);

    }



    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }


}
