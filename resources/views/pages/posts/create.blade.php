@extends('layouts.app')

@section('content')
    <main class="container py-3">

        <h1>Crea un nuovo post</h1>

        <form action="{{ route('dashboard.posts.store') }}" method="POST" enctype="multipart/form-data" >
        @csrf

        <div class="mb-3">
          <label for="" class="form-label">Title</label>
          <input type="text"
            class="form-control
                @error('title')
                    is-invalid
                @enderror"
            name="title"
            id="title"
            />
            @error('title')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
            @enderror
        </div>

        <div class="mb-3">
            <input
                type="file"
                name="cover_image"
                id="cover_image"
                class="form-control
                    @error('cover_image') is-invalid @enderror">
        </div>

        {{-- Aggiungiamo le categories --}}
        <div class="mb-3">
            <label for="category_id" class="form-label">Categories</label>
            <select
                class="
                    form-select
                    form-select-lg
                    @error('category_id') is_invalid @enderror
                    "
                name="category_id"
                id="category_id"
            >
                <option value="">Select one</option>

                @foreach ($categories as $item)
                <option
                    value="{{ $item->id }}"
                    {{ $item->id == old('category_id') ? 'selected' : '' }}
                    >{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Aggiungiamo i tags --}}
        <div class="mb-3">
            <label for="tags" class="form-label">Select Tags</label>

            <select
                multiple

                class="form-select form-select-lg"
                name="tags[]"
                id="tags"
            >
                <option value="">Select one</option>

                @forelse ($tags as $item)

                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @empty

                    <option value="">Non ci sono tags</option>

                @endforelse

            </select>
        </div>

        <div class="mb-3">
          <label for="content" class="form-label">Content</label>
          <textarea class="form-control" name="content" id="content" rows="3"></textarea>
        </div>

        <button class="btn btn-primary">Crea</button>
        </form>


    </main>
@endsection
