@extends('admin.layout')

@section('content')
<div class="card bg-white p-6 mb-8 max-w-xl mx-auto">
    <a href="{{ route('admin.dashboard') }}#entreprises" class="text-blue-600 hover:underline mb-4 inline-block"><i class="fas fa-arrow-left mr-1"></i> Retour au dashboard</a>
    <h2 class="text-2xl font-semibold text-[#437305] mb-4">Ajouter une entreprise</h2>
    <form method="POST" action="{{ route('admin.entreprise.store') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block mb-1">Nom</label>
            <input type="text" name="nom" class="w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block mb-1">Pays</label>
            <select name="pays" class="w-full border rounded p-2" required>
                <option value="Niger">Niger</option>
                <option value="Bénin">Bénin</option>
                <option value="Togo">Togo</option>
            </select>
        </div>
        <div>
            <label class="block mb-1">Ville</label>
            <input type="text" name="ville" class="w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block mb-1">Longitude</label>
            <input type="number" step="any" name="longitude" class="w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block mb-1">Latitude</label>
            <input type="number" step="any" name="latitude" class="w-full border rounded p-2" required>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Ajouter</button>
    </form>
</div>
@endsection