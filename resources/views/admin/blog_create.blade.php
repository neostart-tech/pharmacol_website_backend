{{-- filepath: backend/resources/views/admin/blog_create.blade.php --}}
@extends('admin.layout')

@section('content')
<div class="card bg-white p-6 mb-8 max-w-xl mx-auto">
    <h2 class="text-2xl font-semibold text-[#437305] mb-4">{{ __('messages.add_article') }}</h2>
    <form method="POST" action="{{ route('admin.blog.store') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <label class="block mb-1">{{ __('messages.title') }}</label>
            <input type="text" name="titre" class="w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block mb-1">{{ __('messages.content') }}</label>
            <textarea name="texte" rows="6" class="w-full border rounded p-2" required></textarea>
        </div>
        <div>
            <label class="block mb-1">{{ __('messages.image') }}</label>
            <input type="file" name="image" class="w-full border rounded p-2">
        </div>
        <div>
            <label class="block mb-1">{{ __('messages.state') }}</label>
            <select name="etat" class="w-full border rounded p-2" required>
                <option value="en ligne">{{ __('messages.online') }}</option>
                <option value="brouillon">{{ __('messages.draft') }}</option>
                <option value="newsletter">{{ __('messages.newsletter') }}</option>
                <option value="les 2">{{ __('messages.both') }}</option>
            </select>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">{{ __('messages.add') }}</button>
    </form>
</div>
@endsection