@extends('layouts.app')

@section('content')
    <main class="container py-3">
        <h1>{{ $post->title }}</h1>

        slug: {{ $post->slug }}

        @if ($post->cover_image)
            <img class="img-fluid" src="{{ asset('/storage/' . $post->cover_image ) }}" alt="{{ $post->title }}">
        @endif

        {{-- mostrimao la categoria se presente --}}
        <p>
            <strong>
                {{ $post->category ? $post->category->name : 'Non ci sono categorie' }}
            </strong>
        </p>


        <p class="mt-5">
            {{ $post->content }}
        </p>
    </main>
@endsection
