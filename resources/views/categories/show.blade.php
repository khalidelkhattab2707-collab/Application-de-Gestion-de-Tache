@extends('layouts.app')

@section('title', $category->name)
@section('header', $category->name)

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <p class="text-gray-500">{{ $category->tasks->count() }} tâche(s) dans cette catégorie</p>
    </div>
    <div class="flex space-x-2">
        <a href="{{ route('categories.edit', $category) }}" class="btn-secondary flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            Modifier
        </a>
    </div>
</div>

<div class="card overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Tâche</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Statut</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Date</th>
                <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($category->tasks as $task)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <p class="font-medium text-gray-900">{{ $task->title }}</p>
                        <p class="text-sm text-gray-500">{{ Str::limit($task->description, 40) }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <span class="status-badge status-{{ $task->status }}">
                            {{ $task->status === 'to_do' ? 'À faire' : ($task->status === 'in_progress' ? 'En cours' : 'Terminée') }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $task->due_date?->format('d/m/Y') ?? '-' }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('tasks.show', $task) }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Voir</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                        Aucune tâche dans cette catégorie
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    <a href="{{ route('categories.index') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">← Retour aux catégories</a>
</div>
@endsection