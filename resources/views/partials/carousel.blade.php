<div class="slider">
    <div class="slide-track">
        @for($i = 1; $i <= 2; $i++)
            @for($j = 1; $j <= 7; $j++)
                <div class="slide">
                    <img src="img/{{$j}}.png" height="100" width="250" alt=""/>
                </div>
            @endfor
        @endfor
    </div>
</div>
