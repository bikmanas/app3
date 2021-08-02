<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    // array imitates our model / database

    public function index()
    {
        return view('blogposts', ['posts' => \App\Models\Blogpost::all()]);
    }

    public function show($id)
    {
        foreach ($this->blogPosts as $blogPost) {
            if ($blogPost['id'] == $id) {
                return $blogPost;
            }
        }
    }

    public function store(Request $request)

    {
        $this->validate($request, [
            // [Dėmesio] validacijoje unique turi būti nurodytas teisingas lentelės pavadinimas! Galime pažiūrėti, kas bus jei bus neteisingas
            'title' => 'required|unique:blogposts,title|max:10',
            'text' => 'required',
        ]);

        $bp = new \App\Models\Blogpost();
        $bp->title = $request['title'];
        $bp->text = $request['text'];

        return ($bp->save() == 1)
            ? redirect('/posts')->with('status_success', 'Post was created!')
            : redirect('/posts')->with('status_error', 'Post was not created!');
    }
}
