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
        return view('blogpost', ['post' => \App\Models\Blogpost::find($id)]);
    }




    public function store(Request $request)

    {
        $this->validate($request, [
            // [Dėmesio] validacijoje unique turi būti nurodytas teisingas lentelės pavadinimas! Galime pažiūrėti, kas bus jei bus neteisingas
            'title' => 'required|unique:blogposts,title|max:5',
            'text' => 'required',
        ]);

        $bp = new \App\Models\Blogpost();
        $bp->title = $request['title'];
        $bp->text = $request['text'];

        return ($bp->save() == 1)
            ? redirect('/posts')->with('status_success', 'Post was created!')
            : redirect('/posts')->with('status_error', 'Post was not created!');
    }

    public function update($id, Request $request)
    {
        // [Dėmesio] validacijoje unique turi būti teisingas lentelės pavadinimas!
        $this->validate($request, [
            'title' => 'required|unique:blogposts,title, ' . $id . ',id|max:5',
            'text' => 'required',
        ]);
        $bp = \App\Models\Blogpost::find($id);
        $bp->title = $request['title'];
        $bp->text = $request['text'];
        return ($bp->save() !== 1) ?
            redirect('/posts/' . $id)->with('status_success', 'Post updated!') :
            redirect('/posts/' . $id)->with('status_error', 'Post was not updated!');
    }




    public function destroy($id)
    {
        \App\Models\Blogpost::destroy($id);
        return redirect('/posts')->with('status_success', 'Post deleted!');
    }
}
