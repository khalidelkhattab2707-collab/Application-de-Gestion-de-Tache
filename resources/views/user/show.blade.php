@extends('layouts.app')

@section('title', $user->name)
@section('header', 'Profil Utilisateur')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="card overflow-hidden">
        <!-- Header -->
        <div class="bg-indigo-600 px-6 py-8 text-center">
            <div class="w-24 h-24 bg-white rounded-full mx-auto flex items-center justify-center mb-4">
                <span class="text-3xl font-bold text-indigo-600">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
            </div>
            <h2 class="text-2xl font-bold text-white">{{ $user->name }}</h2>
            <p class="text-indigo-200 mt-1">{{ $user->email }}</p>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-3 divide-x divide-gray-100 border-b border-gray-100">
            <div class="p-6 text-center">
                <p class="text-2xl font-bold text-gray-900">{{ $user->tasks->count() }}</p>
                <p class="text-sm text-gray-500 mt-1">Total tâches</p>
            </div>
            <div class="p-6 text-center">
                <p class="text-2xl font-bold text-green-600">{{ $user->tasks->where('status', 'done')->count() }}</p>
                <p class="text-sm text-gray-500 mt-1">Terminées</p>
            </div>
            <div class="p-6 text-center">
                <p class="text-2xl font-bold text-yellow-600">{{ $user->tasks->where('status', 'to_do')->count() }}</p>
                <p class="text-sm text-gray-500 mt-1">À faire</p>
            </div>
        </div>

        <!-- Tâches récentes -->
        <div class="p-6">
            <h3 class="text-lg font-semibold text