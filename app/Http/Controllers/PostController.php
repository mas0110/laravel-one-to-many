<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();

        return view('pages.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        $tags = Tag::all();

        return view('pages.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $val_data = $request->validated();

        $slug = Post::generateSlug( $request->title );
        $val_data['slug'] = $slug;

        if( $request->hasFile('cover_image') ){

            $path = Storage::disk('public')->put( 'post_images', $request->cover_image );


            $val_data['cover_image'] = $path;
        }

        $new_post = Post::create($val_data);

        if( $request->has( 'tags' ) ){
            $new_post->tags()->attach( $request->tags );
        }

        return redirect()->route('dashboard.posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view( 'pages.posts.show', compact('post') );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
         //ottengo i dati della tabella Categories
         $categories = Category::all();

         $tags = Tag::all();

         return view('pages.posts.edit', compact('post', 'categories', 'tags') );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $val_data = $request->validated();

        //generiamo lo slug in modo dinamico
        $slug = Post::generateSlug($request->title);
        $val_data['slug'] = $slug;

        if( $request->hasFile('cover_image') ){
            if( $post->cover_image ){
                Storage::delete($post->cover_image);
            }

            $path = Storage::disk('public')->put('post_images', $request->cover_image);

            $val_data['cover_image'] = $path;
        }


        $post->update( $val_data );


        if( $request->has('tags') ){
            $post->tags()->sync( $request->tags );
        }

        return redirect()->route('dashboard.posts.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //rimuovo l'associazione tra posts e tags
        $post->tags()->sync([]);

        //cancellazione del file nella cartella storage
        if( $post->cover_image ){
            Storage::delete($post->cover_image);
        }

        //cancellazione del record del DB
        $post->delete();

        return redirect()->route('dashboard.posts.index');

    }
}
