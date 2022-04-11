<h3>Yatzy-protokoll</h3>
<table id="yatzy_protocol">
    <tr>
        <th></th>
        <th>Spelare</th> 
    </tr>


    <tr>
        <td>Ettor</td>

        @if (Session::has('yatzy.dice_0'))
            <td class="yatzy_save"> {{ Session::get('yatzy.dice_0')}} </td>
        @else
            <td class="yatzy_save_link"> <a href="{{ route('yatzy_save', ['key' => 0, 'value' => Session::get('yatzy.sumValues')[0] ?? 0]) }}" >  {{ Session::get('yatzy.sumValues')[0] ?? '' }} </a> </td>
        @endif
    </tr>

    <tr>
        <td>Tvåor</td>
        @if (Session::has('yatzy.dice_1'))
            <td class="yatzy_save"> {{ Session::get('yatzy.dice_1')}} </td>
        @else
            <td class="yatzy_save_link"> <a href="{{ route('yatzy_save', ['key' => 1, 'value' => Session::get('yatzy.sumValues')[1] ?? 0]) }}" >  {{ Session::get('yatzy.sumValues')[1] ?? '' }} </a> </td>
        @endif
    </tr>

    <tr>
        <td>Treor</td>
        @if (Session::has('yatzy.dice_2'))
            <td class="yatzy_save"> {{ Session::get('yatzy.dice_2')}} </td>
        @else
            <td class="yatzy_save_link"> <a href="{{ route('yatzy_save', ['key' => 2, 'value' => Session::get('yatzy.sumValues')[2] ?? 0]) }}" >  {{ Session::get('yatzy.sumValues')[2] ?? '' }} </a> </td>
        @endif
    </tr>

    <tr>
        <td>Fyror</td>
        @if (Session::has('yatzy.dice_3'))
            <td class="yatzy_save"> {{ Session::get('yatzy.dice_3')}} </td>
        @else
            <td class="yatzy_save_link"> <a href="{{ route('yatzy_save', ['key' => 3, 'value' => Session::get('yatzy.sumValues')[3] ?? 0]) }}" >  {{ Session::get('yatzy.sumValues')[3] ?? '' }} </a> </td>
        @endif
    </tr>

    <tr>
        <td>Femmor</td>
        @if (Session::has('yatzy.dice_4'))
            <td class="yatzy_save"> {{ Session::get('yatzy.dice_4')}} </td>
        @else
            <td class="yatzy_save_link"> <a href="{{ route('yatzy_save', ['key' => 4, 'value' => Session::get('yatzy.sumValues')[4] ?? 0]) }}" >  {{ Session::get('yatzy.sumValues')[4] ?? '' }} </a> </td>
        @endif
    </tr>

    <tr>
        <td>Sexor</td>
        @if (Session::has('yatzy.dice_5'))
            <td class="yatzy_save"> {{ Session::get('yatzy.dice_5')}} </td>
        @else
            <td class="yatzy_save_link"> <a href="{{ route('yatzy_save', ['key' => 5, 'value' => Session::get('yatzy.sumValues')[5] ?? 0]) }}" >  {{ Session::get('yatzy.sumValues')[5] ?? '' }} </a> </td>
        @endif
    </tr>


    <tr>
        <td><b>Summa </b></td>
        <td class="yatzy_save"> {{ Session::get('yatzy.sum') }} </td>
    </tr>

    <tr>
        <td><b>Bonus </b></td>
        <td class="yatzy_save">  {{ Session::get('yatzy.bonus') }}</td>
    </tr>


    <!-----------------------------------------------------------------------------------Part 2------------------------------------------------------------------------------------------------------------------->
    <tr>
        <td>Ett par</td>
        @if (Session::has('yatzy.saveOnePair'))
            <td class="yatzy_save"> {{ Session::get('yatzy.saveOnePair')}} </td>
        @else
            <td class="yatzy_save_link"> <a href="{{ route('yatzy_save_part_2', ['key' => 1, 'value' => Session::get('yatzy.part2_1') ?? 0]) }}" >  {{ Session::get('yatzy.part2_1') ?? ''}} </a> </td>
        @endif
    </tr>

    <tr>
        <td>Två par</td>
        @if (Session::has('yatzy.saveTwoPairs'))
            <td class="yatzy_save"> {{ Session::get('yatzy.saveTwoPairs')}} </td>
        @else
            <td class="yatzy_save_link"> <a href="{{ route('yatzy_save_part_2', ['key' => 2, 'value' => Session::get('yatzy.part2_2')?? 0]) }}" >  {{ Session::get('yatzy.part2_2') ?? '' }} </a> </td>
        @endif
    </tr>


    <tr>
        <td>Tretal</td>
        @if (Session::has('yatzy.saveThree'))
            <td class="yatzy_save"> {{ Session::get('yatzy.saveThree')}} </td>
        @else
            <td class="yatzy_save_link"> <a href="{{ route('yatzy_save_part_2', ['key' => 3, 'value' => Session::get('yatzy.part2_3') ?? 0]) }}" >  {{ Session::get('yatzy.part2_3') ?? '' }} </a> </td>
        @endif
    </tr>


    <tr>
        <td>Fyrtal</td>
        @if (Session::has('yatzy.saveFour'))
            <td class="yatzy_save"> {{ Session::get('yatzy.saveFour')}} </td>
        @else
            <td class="yatzy_save_link"> <a href="{{ route('yatzy_save_part_2', ['key' => 4, 'value' => Session::get('yatzy.part2_4') ?? 0]) }}" >  {{ Session::get('yatzy.part2_4') ?? '' }} </a> </td>
        @endif
    </tr>

    <tr>
        <td>Liten stege</td>
        @if (Session::has('yatzy.saveSmallStraight'))
            <td class="yatzy_save"> {{ Session::get('yatzy.saveSmallStraight')}} </td>
        @else
            <td class="yatzy_save_link"> <a href="{{ route('yatzy_save_part_2', ['key' => 5, 'value' => Session::get('yatzy.part2_5') ?? 0]) }}" >  {{ Session::get('yatzy.part2_5') ?? '' }} </a> </td>
        @endif
    </tr>

    <tr>
        <td>Stor stege</td>
        @if (Session::has('yatzy.saveLargeStraight'))
            <td class="yatzy_save"> {{ Session::get('yatzy.saveLargeStraight')}} </td>
        @else
            <td class="yatzy_save_link"> <a href="{{ route('yatzy_save_part_2', ['key' => 6, 'value' => Session::get('yatzy.part2_6') ?? 0]) }}" >  {{ Session::get('yatzy.part2_6') ?? '' }} </a> </td>
        @endif
    </tr>


    <tr>
        <td>Kåk</td>
        @if (Session::has('yatzy.saveFullHouse'))
            <td class="yatzy_save"> {{ Session::get('yatzy.saveFullHouse')}} </td>
        @else
            <td class="yatzy_save_link"> <a href="{{ route('yatzy_save_part_2', ['key' => 7, 'value' => Session::get('yatzy.part2_7') ?? 0]) }}" >  {{ Session::get('yatzy.part2_7') ?? '' }} </a> </td>
        @endif
    </tr>

    <tr>
        <td>Chans</td>
        @if (Session::has('yatzy.saveChance'))
            <td class="yatzy_save"> {{ Session::get('yatzy.saveChance')}} </td>
        @else
            <td class="yatzy_save_link"> <a href="{{ route('yatzy_save_part_2', ['key' => 8, 'value' => Session::get('yatzy.part2_8') ?? 0]) }}" >  {{ Session::get('yatzy.part2_8') ?? '' }} </a> </td>
        @endif
    </tr>

    <tr>
        <td>Yatzy</td>
        @if (Session::has('yatzy.saveYatzy'))
            <td class="yatzy_save"> {{ Session::get('yatzy.saveYatzy')}} </td>
        @else
            <td class="yatzy_save_link"> <a href="{{ route('yatzy_save_part_2', ['key' => 9, 'value' => Session::get('yatzy.part2_9') ?? 0]) }}" >  {{ Session::get('yatzy.part2_9') ?? '' }} </a> </td>
        @endif
    </tr>
    

    <tr>
        <td><b> Totalt </b></td>
        <td class="yatzy_save"> {{ Session::get('yatzy.finalResult') ?? ''}} </td>
    </tr>
    
    

</table>