
<header>
    <nav>
        <li class = "{{ (request()->is('/')) ? 'active' : '' }}"> <a href="{{ route('home') }}">Home</a> </li> |
        <li class = "{{ (request()->is('game')) ? 'active' : '' }}"> <a href="{{ route('game') }}">Game 21</a></li> |
        <li class = "{{ (request()->is('yatzy')) ? 'active' : '' }}"> <a href="{{ route('yatzy') }}">Yatzy</a> </li> |
        <li class = "{{ (request()->is('highscore')) ? 'active' : '' }}"> <a href="{{ route('highscore') }}">HighScore</a> </li> |
        <li class = "{{ (request()->is('histogram')) ? 'active' : '' }}"> <a href="{{ route('histogram') }}">Histogram</a></li>
    </nav>

</header>


