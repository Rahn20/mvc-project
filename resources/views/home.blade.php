@extends('layout.app')

@section('title', 'MVC | Home')


@section('content')

    <h1> Tärningsspel </h1>
        
    <p> Vad vill du göra: </p>

    <ul id="index-page">
        <li> <a href="{{ route('game') }}"> Spela Game 21</a></li>
        <li> <a href="{{ route('yatzy') }}"> Spela Yatzy</a> </li> 
        <li> <a href="{{ route('highscore') }}"> Se HighScore</a> </li>
        <li> <a href="{{ route('histogram') }}"> Se Histogram</a></li>
    </ul>

@endsection

