@extends('layouts.app')

@section('content')
    <main class="container py-3">
        <h1>Lista dei posts</h1>
        <a class="btn btn-primary" href="{{ route('dashboard.posts.create') }}">Create</a>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">title</th>
                        <th scope="col">content</th>
                        <th scope="col">slug</th>
                        <th scope="col">cover image</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $item)
                    <tr class="">
                        <td>{{ $item->id}}</td>
                        <td><a href="{{ route('dashboard.posts.show', $item->slug) }}">{{ $item->title }}</a></td>
                        <td>{{ $item->content }}</td>
                        <td>{{ $item->slug }}</td>
                        <td>{{ $item->cover_image }}</td>
                        <td>
                            <a class="btn btn-primary" href=" {{ route('dashboard.posts.edit', $item->slug ) }} ">
                                Modifica
                            </a>

                            <form method="POST"
                                action=" {{ route( 'dashboard.posts.destroy', $item->slug )}} ">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger mt-2">Delete</button>

                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </main>
@endsection
