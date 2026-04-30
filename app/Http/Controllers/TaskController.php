<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Affiche la liste des tâches de l'utilisateur connecté
     */
    public function index()
    {
        $tasks = Task::with('category')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        $categories = Category::all();
        return view('tasks.create', compact('categories'));
    }

    /**
     * Enregistre une nouvelle tâche
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:to_do,in_progress,done',
            'due_date' => 'nullable|date|after_or_equal:today',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Ajoute automatiquement l'ID de l'utilisateur connecté
        $validated['user_id'] = auth()->id();

        Task::create($validated);

        return redirect()->route('tasks.index')
            ->with('success', 'Tâche créée avec succès !');
    }

    /**
     * Affiche une tâche spécifique
     */
    public function show(Task $task)
    {
        // Vérifie que l'utilisateur est propriétaire de la tâche
        $this->authorize('view', $task);

        $task->load('category', 'user');
        return view('tasks.show', compact('task'));
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        $categories = Category::all();
        return view('tasks.edit', compact('task', 'categories'));
    }

    /**
     * Met à jour une tâche
     */
    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:to_do,in_progress,done',
            'due_date' => 'nullable|date',
            'category_id' => 'required|exists:categories,id',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')
            ->with('success', 'Tâche mise à jour avec succès !');
    }

    /**
     * Supprime une tâche
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Tâche supprimée avec succès !');
    }
}