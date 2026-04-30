@extends('layouts.app')

@section('title', 'Tableau de bord')
@section('header', 'Tableau de bord')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Carte Tâches -->
    <div class="card p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Mes tâches</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ auth()->user()->tasks()->count() }}</p>
            </div>
            <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
        </div>
        <div class="mt-4 flex space-x-4 text-sm">
            <span class="text-yellow-600">{{ auth()->user()->tasks()->where('status', 'to_do')->count() }} à faire</span>
            <span class="text-blue-600">{{ auth()->user()->tasks()->where('status', 'in_progress')->count() }} en cours</span>
            <span class="text-green-600">{{ auth()->user()->tasks()->where('status', 'done')->count() }} terminées</span>
        </div>
    </div>

    <!-- Carte Catégories -->
    <div class="card p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Catégories</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ \App\Models\Category::count() }}</p>
            </div>
            <div class="w-12 h-12 bg-pink-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Carte Tâches en retard -->
    <div class="card p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Tâches en retard</p>
                <p class="text-3xl font-bold text-red-600 mt-2">
                    {{ auth()->user()->tasks()->where('due_date', '<', now())->where('status', '!=', 'done')->count() }}
                </p>
            </div>
            <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Tâches récentes -->
<div class="card">
    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
        <h3 class="text-lg font-semibold text-gray-800">Tâches récentes</h3>
        <a href="{{ route('tasks.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Voir tout</a>
    </div>
    <div class="divide-y divide-gray-100">
        @forelse(auth()->user()->tasks()->latest()->take(5)->get() as $task)
            <div class="px-6 py-4 flex items-center justify-between hover:bg-gray-50 transition-colors">
                <div class="flex items-center space-x-4">
                    <div class="w-2 h-2 rounded-full 
                        {{ $task->status === 'done' ? 'bg-green-500' : ($task->status === 'in_progress' ? 'bg-blue-500' : 'bg-yellow-500') }}">
                    </div>
                    <div>
                        <p class="font-medium text-gray-900">{{ $task->title }}</p>
                        <p class="text-sm text-gray-500">{{ $task->category->name }} • {{ $task->due_date?->format('d/m/Y') ?? 'Sans date' }}</p>
                    </div>
                </div>
                <span class="status-badge status-{{ $task->status }}">
                    {{ $task->status === 'to_do' ? 'À faire' : ($task->status === 'in_progress' ? 'En cours' : 'Terminée') }}
                </span>
            </div>
        @empty
            <div class="px-6 py-8 text-center text-gray-500">
                Aucune tâche pour le moment. <a href="{{ route('tasks.create') }}" class="text-indigo-600 hover:underline">Créer une tâche</a>
            </div>
        @endforelse
    </div>
</div>
@endsection