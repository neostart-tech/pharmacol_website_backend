{{-- filepath: backend/resources/views/admin/blog_edit.blade.php --}}
@extends('admin.layout')

@section('content')
<div class="card bg-white p-6 mb-8 max-w-xl mx-auto">
    <h2 class="text-2xl font-semibold text-[#437305] mb-4">{{ __('messages.modify_article') }}</h2>
    <form method="POST" action="{{ route('admin.blog.update', $blog->id) }}" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block mb-1">{{ __('messages.title') }}</label>
            <input type="text" name="titre" class="w-full border rounded p-2" value="{{ $blog->titre }}" required>
        </div>
        <div>
            <label class="block mb-1">{{ __('messages.content') }}</label>
            <textarea name="texte" rows="6" class="w-full border rounded p-2" required>{{ $blog->texte }}</textarea>
        </div>
        <div>
            <label class="block mb-1">{{ __('messages.image') }}</label>
            <input type="file" name="image" class="w-full border rounded p-2">
            @if($blog->image)
                <img src="{{ asset($blog->image) }}" class="h-16 mt-2">
            @endif
        </div>
        <div>
            <label class="block mb-1">{{ __('messages.state') }}</label>
            <select name="etat" class="w-full border rounded p-2" required>
                <option value="en ligne" @if($blog->etat == 'en ligne') selected @endif>{{ __('messages.online') }}</option>
                <option value="brouillon" @if($blog->etat == 'brouillon') selected @endif>{{ __('messages.draft') }}</option>
                <option value="newsletter" @if($blog->etat == 'newsletter') selected @endif>{{ __('messages.newsletter') }}</option>
                <option value="les 2" @if($blog->etat == 'les 2') selected @endif>{{ __('messages.both') }}</option>
            </select>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">{{ __('messages.save') }}</button>
    </form>
</div>
@endsection