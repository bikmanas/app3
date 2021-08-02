@extends('layouts.master')
@section('content')
    {{-- Validation error, for invalid incoming data display logic --}}
    @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                <p style="color: red">{{ $error }}</p>
            @endforeach
        </div>
    @endif

    {{-- Database error/success display logic --}}
    @if (session('status_success'))
        <p style="color: green"><b>{{ session('status_success') }}</b></p>
    @else
        <p style="color: red"><b>{{ session('status_error') }}</b></p>
    @endif


    @foreach ($posts as $post)
        <h1>{{ $post['title'] }}</h1>
        <p>{{ $post['text'] }}</p>
    @endforeach

    <hr>
    <form method="POST" action="/posts">
        @csrf
        <label for="title">Post title:</label><br>
        <input type="text" id="title" name="title"><br>
        <label for="text">Post text:</label><br>
        <input type="text" id="text" name="text"><br><br>
        <input class="btn btn-primary" type="submit" value="Submit">
    </form>

@endsection
