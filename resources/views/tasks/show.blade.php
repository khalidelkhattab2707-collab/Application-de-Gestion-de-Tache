@extends('layouts.app')

@section('title', $task->title)
@section('header', 'Détail de la Tâche')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="card overflow-hidden">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <span class="status-badge status-{{ $task->status }}">
                    {{ $task->status === 'to_do' ? 'À faire' : ($task->status === 'in_progress' ? 'En cours' : 'Terminée') }}
                </span>
                <span class="text-sm text-gray-500">Créée le {{ $task->created_at->format('d/m/Y à H:i') }}</span>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('tasks.edit', $task) }}" class="btn-secondary flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Modifier
                </a>
            </div>
        </div>

        <!-- Content -->
        <div class="p-6 space-y-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $task->title }}</h1>
                <div class="flex items-center space-x-4 text-sm text-gray-500">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        {{ $task->category->name }}
                    </span>
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        {{ $task->user->name }}
                    </span>
                </div>
            </div>

            @if($task->description)
                <div class="bg-gray-50 rounded-lg p-4">
                    <h4 class="text-sm font-semibold text-gray-700 mb-2">Description</h4>
                    <p class="text-gray-600 whitespace-pre-line">{{ $task->description }}</p>
                </div>
            @endif

            <div class="grid grid-cols-2 gap-4">
                <div class="bg-gray-50 rounded-lg p-4">
                    <h4 class="text-sm font-semibold text-gray-700 mb-1">Date d'échéance</h4>
                    <p class="text-gray-900">
                        @if($task->due_date)
                            <span class="{{ $task->due_date < now() && $task->status !== 'done' ? 'text-red-600 font-semibold' : '' }}">
                                {{ $task->due_date->format('d/m/Y') }}
                            </span>
                            @if($task->due_date < now() && $task->status !== 'done')
                                <span class="text-red-500 text-sm ml-2">(En retard)</span>
                            @endif
                        @else
                            <span class="text-gray-400">Non définie</span>
                        @endif
                    </p>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <h4 class="text-sm font-semibold text-gray-700 mb-1">Dernière modification</h4>
                    <p class="text-gray-900">{{ $task->updated_at->format('d/m/Y à H:i') }}</p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-between items-center">
            <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Supprimer
                </button>
            </form>
            <a href="{{ route('tasks.index') }}" class="btn-secondary">Retour à la liste</a>
        </div>
    </div>
</div>
@endsection