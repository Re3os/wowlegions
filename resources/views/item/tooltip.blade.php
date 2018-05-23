<div class="wiki-tooltip">
<span  class="icon-frame frame-56 " style='background-image: url("https://render-eu.worldofwarcraft.com/icons/56/.jpg");'>
</span>
<h3 class="color-q{{ $item['Quality'] }}">{{ $item['Name'] }}</h3>
<ul class="item-specs" style="margin: 0">
    @if($item['Flags'] & 0x00000008)
    <li class="color-tooltip-green">Героический</li>
    @endif
<li>Становится персональным при получении</li>
<li><span class="float-right">Miscellaneous</span></li>
<li id="stat-4">+<span>11</span> к силе</li>
<li id="stat-3">+<span>6</span> к ловкости</li>
<li>Требуется уровень 55</li>
<li>Уровень предмета 60</li>
<li id="stat-32" class="color-tooltip-green">+<span>4</span>  к критическому удару</li>
<li>Цена продажи: <span class="icon-silver">1</span><span class="icon-copper">33</span></li>
</ul>
<span class="clear"><!-- --></span>
</div>