@extends('layout.app')

@section('title', 'MVC | Game 21')


@section('content')

<h1> Game 21 </h1>
        
    <p>Välkommen till spelet 21</p>
    <p>Hur många tärningar vill du spela med?</p>


    <form class = "game" method="POST" action="{{ route('play-game') }}">
        @csrf

        <select name='select'>
            <option name="1" value="1"> 1
            <option name="2" value="2"> 2
        <select>

        <p>
            <input type="submit" name="submit" value="Kasta">
            <input type="submit" name="submit" value="Stanna">

            @if (Session::has('play.result'))
                <input type="submit" name="submit" value="Ny runda"> 
            @endif

        </p>
        <p class="destroy"><a href="{{ route('destroy-game') }}"> Nollställ poäng </a> </p>
    </form> 


    @if (Session::has('play'))

        <p class="dice-utf8">
            @foreach (Session::get('play.graphic') as $item)
                <i class="{{ $item }}"></i>
            @endforeach
        </p>

        @if (Session::has('play.result'))
            <p>Spelarens poäng: {{ Session::get('play.player') }}</p>
            <p>Datorns poäng: {{ Session::get('play.computer') }} </p>
            <h1> {{ Session::get('play.result') }}</h1>

        @else 
            <p>Senaste slaget: {{ Session::get('play.hand') }}</p>
            <p>Spelarens poäng: {{ Session::get('play.player') }}</p>
            <p>Datorns poäng: {{ Session::get('play.computer') }} </p>
            <p>Spelrunda: {{ Session::get('play.rounds') }}</p>
            <p>Totala spelarens poäng: {{ Session::get('play.playerPoints') }} </p>
            <p>Totala dators poäng: {{ Session::get('play.computerPoints') }}</p>
        @endif

    @endif
        

@endsection