@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Les profils') }}
    </h2>

    <p class="mt-1 text-sm text-gray-600">
        {{ __("Bienvenue sur notre page d'administration, le cœur battant de notre communauté !Ici, nos
        administrateurs ont le pouvoir magique de personnaliser et d'optimiser l'expérience de chaque utilisateur.
        Grâce à cette fonctionnalité, nos administrateurs peuvent apporter des changements bienveillants,
        répondant aux besoins spécifiques de chacun. ") }}
    </p>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">


                    <!--EN TETE-->
                    <table class="min-w-full bg-white border border-gray-300">
                        <thead>
                        <tr>
                            <th class="py-2 px-2 border-b">Id</th>
                            <th class="py-2 px-2 border-b">Nom</th>
                            <th class="py-2 px-2 border-b">Email</th>
                            <th class="py-2 px-2 border-b">Role</th>
                            <th class="py-2 px-2 border-b">Statut</th>
                            <th class="py-2 px-2 border-b">Date d'inscription</th>
                            <th class="py-2 px-2 border-b">Dernière modification</th>
                            <th class="py-2 px-2 border-b">MODIFIER</th>
                            <th class="py-2 px-2 border-b">SUPPRIMER</th>
                            <th class="py-2 px-2 border-b">#</th>
                        </tr>
                        </thead>

                        <!--VALEUR TABLEAU -->

                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="py-2 px-2 border-b">{{ $user->id }}</td>
                                <td class="py-2 px-2 border-b">{{ $user->name }}</td>
                                <td class="py-2 px-2 border-b">{{ $user->email }}</td>
                                <td class="py-2 px-2 border-b">@if($user->role == 'Logged-in-user')
                                        Utilisateur connecté
                                    @elseif($user->role == 'Admin')
                                        Administrateur
                                    @elseif($user->role == 'Supervisor')
                                        Superviseur
                                    @else
                                        Invité
                                    @endif
                                </td>
                                <td class="py-2 px-2 border-b">{{ ($user->user_status == 1) ? 'actif':'non-actif' }}</td>
                                <td class="py-2 px-2 border-b">{{ $user->created_at->format('d/m/Y - H:i') }}</td>
                                <td class="py-2 px-2 border-b">{{ $user->updated_at->format('d/m/Y - H:i') }}</td>

                                <!------------------------------------------------------------>
                                <td class="py-2 px-2 border-b">
                                    <button
                                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                        onclick="showEditForm({{ $user->id }})"> &#9999;&#65039;
                                    </button>
                                </td><!-- modifier -->

                                <td class="py-2 px-2 border-b">
                                    <button class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md
                                    focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        &#128465;&#65039;
                                    </button><!-- supprimer -->
                                </td>
                                <!------------------------------------------------------------>

                                <td class="py-2 px-2 border-b">{{ ($user->id == auth()->user()->id) ? '- Moi -' : '' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>


                    <br><hr class="my-8"><br>
                    <!-- FORMULAIRE DE MODIFICATION -->
                    <div>
                        @foreach($users as $user)

                            <!-- Modification 4: Ajout d'une classe et de l'attribut data-user-id -->
                            <form method="post" action="{{ route('admin.updateUser', ['user' => $user->id]) }}"
                                  class="edit-form" data-user-id="{{ $user->id }}" style="display: none;">

                                @csrf
                                @method('post')

                                <!-- Modif nom -->
                                <div>
                                    <x-input-label for="name_{{ $user->id }}" :value="__('Nom')"/>
                                    <x-text-input id="name_{{ $user->id }}" name="name_{{ $user->id }}" type="text" class="mt-1 block w-full"
                                                  :value="old('name_' . $user->id, $user->name)" required autofocus
                                                  autocomplete="name"/>
                                    <x-input-error class="mt-2" :messages="$errors->get('name_' . $user->id)"/>
                                </div>

                                <!-- Modif email -->
                                <div>
                                    <x-input-label for="email_{{ $user->id }}" :value="__('Email')"/>
                                    <x-text-input id="email_{{ $user->id }}" name="email_{{ $user->id }}" type="email" class="mt-1 block w-full"
                                                  :value="old('email_' . $user->id, $user->email)" required autocomplete="username"/>
                                    <x-input-error class="mt-2" :messages="$errors->get('email_' . $user->id)"/>
                                </div>

                                <!-- Modif role -->
                                <div>
                                    <x-input-label for="role_{{ $user->id }}" :value="__('Role')" />
                                    <x-text-input id="role_{{ $user->id }}" name="role_{{ $user->id }}" :value="old('role_' . $user->id, $user->role)" />
                                </div>

                                <br>

                                <x-primary-button>>> Enregistrer</x-primary-button>
                            </form>
                        @endforeach
                    </div>
                    <!-- FIN DU FORMULAIRE DE MODIFICATION -->



                    <!-- Afficher un message de succès -->
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif



                    <script>
                        function showEditForm(userId) {
                            console.log('showEditForm called for userId:', userId);

                            $('.edit-form').hide();
                            $('.edit-form[data-user-id="' + userId + '"]').show();
                        }
                    </script>

                </div>
            </div>
        </div>
    </div>
@endsection
