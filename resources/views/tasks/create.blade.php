@extends('layouts.app')

@section('title', 'Nouvelle Tâche')
@section('header', 'Nouvelle Tâche')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="card">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800">Créer une tâche</h3>
        </div>
        
        <form action="{{ route('tasks.store') }}" method="POST" class="p-6 space-y-6">
            @csrf
            
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Titre <span class="text-red-500">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" 
                    class="w-full px-4 py-2 border {{ $errors->has('title') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors" 
                    placeholder="Titre de la tâche">
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" id="description" rows="4" 
                    class="w-full px-4 py-2 border {{ $errors->has('description') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors" 
                    placeholder="Description détaillée...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Catégorie <span class="text-red-500">*</span></label>
                    <select name="category_id" id="category_id" 
                        class="w-full px-4 py-2 border {{ $errors->has('category_id') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                        <option value="">Sélectionner une catégorie</option>
                        @foreach(\App\Models\Category::all() as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Statut</label>
                    <select name="status" id="status" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                        <option value="to_do" {{ old('status') == 'to_do' ? 'selected' : '' }}>À faire</option>
                        <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>En cours</option>
                        <option value="done" {{ old('status') == 'done' ? 'selected' : '' }}>Terminée</option>
                    </select>
                </div>
            </div>

            <div>
                <label for="due_date" class="block text-sm font-medium text-gray-700 mb-2">Date d'échéance</label>
                <input type="date" name="due_date" id="due_date" value="{{ old('due_date') }}" 
                    class="w-full px-4 py-2 border {{ $errors->has('due_date') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                @error('due_date')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-100">
                <a href="{{ route('tasks.index') }}" class="btn-secondary">Annuler</a>
                <button type="submit" class="btn-primary">Créer la tâche</button>
            </div>
        </form>
    </div>
</div>
@endsection