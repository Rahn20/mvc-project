@extends('layout.app')

@section('title', 'MVC | Yatzy')


@section('content')

<h1> Yatzy </h1>
        
    <p>Du kan välja spara/behålla dina tärningar, sparar du värdet på tärningar får du börja med 3 slag igen. Du har 3 slag och 5 tärningar. 
        Du kan behålla tärningar och försätta kasta, du har rätt till högst 3 tärningskast.
    </p>

    <p> Antal tärningskast: {{ Session::get('yatzy.number') ?? 0 }}</p>
    <p class="destroy"><a href="{{ route('destroy-yatzy') }}"> Nollställ poäng </a> </p>


    <div class="yatzy_protocol">
        @include('yatzy/yatzy_protocol') 
    </div>



    <form class="yatzy" method="POST" action="{{ route('play-yatzy') }}">
        @csrf
        
        <p> <input class="throw_button" type="submit" name="submit" value="Kasta"></p>
        <hr>

        <div class="yatzy-dice">
            @if (Session::has('yatzy.values'))
        
                <p class="dice-utf8">
                    @foreach (Session::get('yatzy.values') as $item)
                        <a href="{{ route('yatzy_play', $item) }}"> <i class="dice-{{$item}}"></i> </a>
                    @endforeach
                </p>
        
        
                @if (Session::has('yatzy.keepDice'))
                    <p class="dice-utf8 yatzy-keep-dice">
                        @foreach (Session::get('yatzy.keepDice') as $item)
                            <i class="dice-{{$item}}"></i>
                        @endforeach
                    </p>
        
                @endif
        
            @endif
        </div>

    </form> 


@endsection