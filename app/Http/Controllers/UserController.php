<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    
     // Affiche la liste des utilisateurs
     
    public function index()
    {
        $users = User::withCount('tasks')->latest()->get();
        return view('user.index', compact('users'));
    }

    
      //Affiche le formulaire de création
    
    public function create()
    {
        return view('user.create');
    }

    
      //Enregistre un nouvel utilisateur
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('users.index')
            ->with('success', 'Utilisateur créé avec succès !');
    }

    
     //Affiche un utilisateur spécifique
     
    public function show(User $user)
    {
        $user->load(['tasks.category']);
        return view('user.show', compact('user'));
    }

    
      //Affiche le formulaire d'édition
    
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    
     //Met à jour un utilisateur
     
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Hash le mot de passe seulement s'il est fourni
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('users.index')
            ->with('success', 'Utilisateur mis à jour avec succès !');
    }

    
     //Supprime un utilisateur
     
    public function destroy(User $user)
    {
        // Empêche la suppression de son propre compte
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')
                ->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Utilisateur supprimé avec succès !');
    }
}