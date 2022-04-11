@extends('layout.app')

@section('title', 'MVC | HighScore')


@section('content')

<h1> HighScore</h1>

    <h3> HighScore lista för Game21</h3>

        <table class="highscore-table">
            <tr>
                <th> Vinnare </th>
                <th> Score </th>
                <th> Datum och Tid </th>
            </tr>

            @foreach ($scores as $score)
                <tr class="scores">
                    <td> {{ $score['winner'] }}</td>
                    <td> {{ $score['score'] }}</td>
                    <td> {{ $score['created'] }}</td>
                    <td> <a href="{{ route('delete-one', ['id' => $score['id']]) }}"> Radera </a></td>
                </tr>
            @endforeach

        </table>



    <div class="highscore">
        <h3> HighScore lista för Yatzy</h3>

        <table class="highscore-table">
            <tr>
                <th> Score </th>
                <th> Datum och Tid </th>
            </tr>

            @foreach ($yatzyScore as $score)
                <tr class="scores">
                    <td> {{ $score['score'] }}</td>
                    <td> {{ $score['created'] }}</td>
                    <td> <a href="{{ route('deleteYatzy-one', ['id' => $score['id']]) }}"> Radera </a></td>
                </tr>
            @endforeach

        </table>
    </div>


@endsection

