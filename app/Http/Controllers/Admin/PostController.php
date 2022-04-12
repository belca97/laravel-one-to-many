<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all(); //recupero i miei post dal mio database
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::all();

        return view('admin.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|min:5',
                'content' => 'required|min:10',
                'category_id' => 'nullable|exists:categories,id',  //<- previene un inserimento errato
                //nella select
            ]
            );

        $data = $request->all();

        // Titolo : impara a programmare

        //Titolo -> slug = impara-a-programmare

        $slug = Str::slug($data['title']); //<- Il metodo slug genera un url amichevole da una stringa ricevuta


        $counter = 1;

        while(Post::where('slug', $slug)->first()) {

            //Utilizzo un contatore per evitare omonimia sui titoli, se il titolo è uguale
            //allora verrà messo un numero identificato dal contatore

            $slug = Str::slug($data['title']) . '-' . $counter;
            $counter++;

        }

        $data ['slug'] = $slug;

        $post = new Post();
        $post->fill($data);
        $post->save();

        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post) //<- Dependency injection
    {
        return view('admin.post.show' , compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {

        $categories = Category::all();


        return view('admin.post.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Post $post, Request $request)
    {
        $request->validate(
            [
                'title' => 'required|min:5',
                'content' => 'required|min:10',
                'category_id' => 'nullable|exists:categories,id'
            ]
            );

        $data = $request->all();

        // Titolo : impara a programmare

        //Titolo -> slug = impara-a-programmare

        $slug = Str::slug($data['title']); //<- Il metodo slug genera un url amichevole da una stringa ricevuta

        if($post->slug != $slug){

            $counter = 1;

        while(Post::where('slug', $slug)->first()) {

            //Utilizzo un contatore per evitare omonimia sui titoli, se il titolo è uguale
            //allora verrà messo un numero identificato dal contatore

            $slug = Str::slug($data['title']) . '-' . $counter;
            $counter++;

        }

        $data ['slug'] = $slug;

        }

        

        $post->update($data);
        $post->save();

        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
