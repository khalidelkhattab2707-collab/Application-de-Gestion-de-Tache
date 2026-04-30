@extends('layouts.app')

@section('title', 'Mes Tâches')
@section('header', 'Mes Tâches')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div class="flex space-x-2">
        <a href="{{ route('tasks.index') }}" class="px-4 py-2 rounded-lg text-sm font-medium {{ !request('status') ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-700' }}">Toutes</a>
        <a href="{{ route('tasks.index', ['status' => 'to_do']) }}" class="px-4 py-2 rounded-lg text-sm font-medium {{ request('status') === 'to_do' ? 'bg-yellow-500 text-white' : 'bg-gray-100 text-gray-700' }}">À faire</a>
        <a href="{{ route('tasks.index', ['status' => 'in_progress']) }}" class="px-4 py-2 rounded-lg text-sm font-medium {{ request('status') === 'in_progress' ? 'bg-blue-500 text-white' : 'bg-gray-100 text-gray-700' }}">En cours</a>
        <a href="{{ route('tasks.index', ['status' => 'done']) }}" class="px-4 py-2 rounded-lg text-sm font-medium {{ request('status') === 'done' ? 'bg-green-500 text-white' : 'bg-gray-100 text-gray-700' }}">Terminées</a>
    </div>
    <a href="{{ route('tasks.create') }}" class="btn-primary flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Nouvelle tâche
    </a>
</div>

<div class="card overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tâche</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Catégorie</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Statut</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Date d'échéance</th>
                <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($tasks as $task)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="ml-0">
                                <p class="font-medium text-gray-900">{{ $task->title }}</p>
                                <p class="text-sm text-gray-500 truncate max-w-xs">{{ Str::limit($task->description, 50) }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                            {{ $task->category->name }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="status-badge status-{{ $task->status }}">
                            {{ $task->status === 'to_do' ? 'À faire' : ($task->status === 'in_progress' ? 'En cours' : 'Terminée') }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        @if($task->due_date)
                            <span class="{{ $task->due_date < now() && $task->status !== 'done' ? 'text-red-600 font-semibold' : '' }}">
                                {{ $task->due_date->format('d/m/Y') }}
                            </span>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end space-x-2">
                            <a href="{{ route('tasks.show', $task) }}" class="text-gray-400 hover:text-indigo-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
                            <a href="{{ route('tasks.edit', $task) }}" class="text-gray-400 hover:text-indigo-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer cette tâche ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-400 hover:text-red-600 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                        <svg class="w-12 h-12 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <p class="text-lg font-medium">Aucune tâche trouvée</p>
                        <a href="{{ route('tasks.create') }}" class="text-indigo-600 hover:underline mt-2 inline-block">Créer votre première tâche</a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection