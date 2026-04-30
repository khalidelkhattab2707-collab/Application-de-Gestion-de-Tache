@extends('layouts.app')

@section('title', 'Nouvelle Catégorie')
@section('header', 'Nouvelle Catégorie')

@section('content')
<div class="max-w-lg mx-auto">
    <div class="card">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800">Créer une catégorie</h3>
        </div>
        
        <form action="{{ route('categories.store') }}" method="POST" class="p-6 space-y-6">
            @csrf
            
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nom <span class="text-red-500">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" 
                    class="w-full px-4 py-2 border {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors" 
                    placeholder="Nom de la catégorie">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-100">
                <a href="{{ route('categories.index') }}" class="btn-secondary">Annuler</a>
                <button type="submit" class="btn-primary">Créer</button>
            </div>
        </form>
    </div>
</div>
@endsection