@extends('layouts.master')
@section('content')
@isset($var)
    @if($var === "Povilas")
        <h1>Labas, {{$var}}!</h1>
    @elseif($var === "Paul")
        <h1>Hi, {{$var}}!</h1>
    @endif 
@endisset

    @isset($letters)
        <h1>Letters:</h1>
        @foreach($letters as $letter)
            {{$letter}}
            <br>
        @endforeach
    @endisset


    @isset($people)
        @foreach($people as $person)
            {{$person -> age}} {{$person->name}}
        @endforeach
    @endisset
@endsection 