@extends('layouts.app')

@section('content')
    <main class="container py-3">

        <h1>Modifica: {{ $post->title }}</h1>

        <form
            action=" {{ route('dashboard.posts.update', $post->slug ) }} "
            method="POST"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input
                    type="text"
                    class="form-control
                        @error('title')
                            is-invalid
                        @enderror"
                    name="title"
                    id="title"
                    value="{{ old( 'title', $post->title ) }}"
                />
                @error('title')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                {{-- mostro la precedente immagine del post se esiste --}}
                @if( $post->cover_image )
                <img
                    src="{{ asset('/storage/' . $post->cover_image) }}"
                    alt="{{ $post->title }}">
                @endif

                <div class="mt-3">
                    <label for="cover_image">Carica una nuova immagine</label>
                    <input
                    type="file"
                    name="cover_image"
                    id="cover_image"
                    class="form-control
                        @error('cover_image') is-invalid @enderror">
                </div>
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
                        {{ $item->id == old('category_id', $post->category ? $post->category->id : '') ? 'selected' : '' }}
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

                        {{-- controllo di validazione --}}

                        @if ( $errors->any() )
                            <option
                                value="{{ $item->id }}"
                                {{ in_array($item->id, old( 'tags', [] )) ? 'selected' : '' }}
                                >
                                {{ $item->name }}
                            </option>

                            @else

                            <option
                                value="{{ $item->id }}"
                                {{ $post->tags->contains( $item->id ) ? 'selected' : '' }}
                                >
                                {{$item->name}}
                            </option>

                        @endif
                    @empty

                        <option value="">Non ci sono tags</option>

                    @endforelse

                </select>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" name="content" id="content" rows="3">{{ old( 'content', $post->content ) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Modifica</button>



        </form>

    </main>
@endsection
