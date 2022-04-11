@extends('layout.app')

@section('title', 'MVC | Histogram')


@section('content')

    <h1> Hoistogram </h1>
        

    <div class="histogram">
        <table id="q-graph">
            <caption>Game21 Histogram</caption>
            <thead>
            <tr>
                <th></th>
                <th class="computer">Dator</th>
                <th class="player">Spelare</th>
            </tr>
            </thead>

            <tbody>
                <tr id="q1">
                    <th scope="row"> Mellan 1-3 poäng</th>
                    <td class="computer bar" style="height: {{ $computer[6] }} px;"></td>
                    <td class="player bar" style="height: {{ $player[6] }} px;"></td>
                </tr>
                <tr id="q2">
                    <th scope="row">Mellan 4-6 poäng</th>
                    <td class="computer bar" style="height: {{ $computer[5] }}px;"></td>
                    <td class="player bar" style="height: {{ $player[5] }}px;"></td>
                </tr>
                <tr id="q3">
                    <th scope="row">Mellan 7-9 poäng</th>
                    <td class="computer bar" style="height: {{ $computer[4] }}px;"></td>
                    <td class="player bar" style="height: {{ $player[4] }}px;"></td>
                </tr>
                <tr id="q4">
                    <th scope="row">Mellan 10-12 poäng</th>
                    <td class="computer bar" style="height: {{ $computer[3] }}px;"></td>
                    <td class="player bar" style="height: {{ $player[3] }}px;"></td>
                </tr>

                <tr id="q5">
                    <th scope="row">Mellan 13-15 poäng</th>
                    <td class="computer bar" style="height: {{ $computer[2] }}px;"></td>
                    <td class="player bar" style="height: {{ $player[2] }}px;"></td>
                </tr>
                <tr id="q6">
                    <th scope="row">Mellan 16-18 poäng</th>
                    <td class="computer bar" style="height: {{ $computer[1] }}px;"></td>
                    <td class="player bar" style="height: {{ $player[1] }}px;"></td>
                </tr>
                <tr id="q7">
                    <th scope="row">Mellan 19-21 poäng</th>
                    <td class="computer bar" style="height: {{ $computer[0] }}px;"></td>
                    <td class="player bar" style="height: {{ $player[0] }}px;"></td>
                </tr>
            </tbody>
        </table>
        
        <div id="ticks">
            <div class="tick" style="height: 59px;"><p>100%</p></div>
            <div class="tick" style="height: 59px;"><p>80%</p></div>
            <div class="tick" style="height: 59px;"><p>60%</p></div>
            <div class="tick" style="height: 59px;"><p>40%</p></div>
            <div class="tick" style="height: 59px;"><p>20%</p></div>
        </div>

    </div>


    <div class="histogram">
        <table id="q-graph">
            <caption>Yatzy Histogram</caption>
            <thead>
            <tr>
                <th class="player">Spelare</th>
            </tr>
            </thead>
            <tbody>
            <tr class="qtr" id="q1">
                <th scope="row"> Mellan 0-50 poäng</th>
                <td class="player yatzy" style="height: {{ $yatzy[0] }}px;"></td>
            </tr>
            <tr class="qtr" id="q2">
                <th scope="row">Mellan 51-100 poäng</th>
                <td class="player yatzy" style="height: {{ $yatzy[1] }}px;"></td>
            </tr>
            <tr class="qtr" id="q3">
                <th scope="row">Mellan 101-150 poäng</th>
                <td class="player yatzy" style="height: {{ $yatzy[2] }}px;"></td>
            </tr>
            <tr class="qtr" id="q4">
                <th scope="row">Mellan 151-200 poäng</th>
                <td class="player yatzy" style="height: {{ $yatzy[3] }}px;"></td>
            </tr>
    
            <tr class="qtr" id="q5">
                <th scope="row">Mellan 201-250 poäng</th>
                <td class="player yatzy" style="height: {{ $yatzy[4] }}px;"></td>
            </tr>
            <tr class="qtr" id="q6">
                <th scope="row">Mellan 251-300 poäng</th>
                <td class="player yatzy" style="height: {{ $yatzy[5] }}px;"></td>
            </tr>
            <tr class="qtr" id="q7">
                <th scope="row">Mellan 300-374 poäng</th>
                <td class="player yatzy" style="height: {{ $yatzy[6] }}px;"></td>
            </tr>
            </tbody>
        </table>
            
            <div id="ticks">
                <div class="tick" style="height: 59px;"><p>100%</p></div>
                <div class="tick" style="height: 59px;"><p>80%</p></div>
                <div class="tick" style="height: 59px;"><p>60%</p></div>
                <div class="tick" style="height: 59px;"><p>40%</p></div>
                <div class="tick" style="height: 59px;"><p>20%</p></div>
            </div>
    
        </div>


@endsection

