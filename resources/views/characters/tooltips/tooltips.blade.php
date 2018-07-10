@php
$item_slots_left = array(
    '0'      => array('modal' => 'item-slot-modal-head',  'tooltip' => 'tooltip-head', 'GameIcon' => 'slotHead'),
    '1'      => array('modal' => 'item-slot-modal-neck',  'tooltip' => 'tooltip-neck', 'GameIcon' => 'slotNeck'),
    '2'      => array('modal' => 'item-slot-modal-shoulder',  'tooltip' => 'tooltip-shoulder', 'GameIcon' => 'slotShoulder'),
    '14'     => array('modal' => 'item-slot-modal-back',  'tooltip' => 'tooltip-back', 'GameIcon' => 'slotBack'),
    '4'      => array('modal' => 'item-slot-modal-chest',  'tooltip' => 'tooltip-chest', 'GameIcon' => 'slotChest'),
    '3'      => array('modal' => 'item-slot-modal-shirt',  'tooltip' => 'tooltip-shirt', 'GameIcon' => 'slotShirt'),
    '18'     => array('modal' => 'item-slot-modal-tabard',  'tooltip' => 'tooltip-tabard', 'GameIcon' => 'slotTabard'),
    '8'      => array('modal' => 'item-slot-modal-wrist',  'tooltip' => 'tooltip-wrist', 'GameIcon' => 'slotWrist'),
    '9'      => array('modal' => 'item-slot-modal-hand',  'tooltip' => 'tooltip-hand', 'GameIcon' => 'slotHand'),
    '5'      => array('modal' => 'item-slot-modal-waist',  'tooltip' => 'tooltip-waist', 'GameIcon' => 'slotWaist'),
    '6'      => array('modal' => 'item-slot-modal-leg',  'tooltip' => 'tooltip-leg', 'GameIcon' => 'slotLeg'),
    '7'      => array('modal' => 'item-slot-modal-foot',  'tooltip' => 'tooltip-foot', 'GameIcon' => 'slotFoot'),
    '10'     => array('modal' => 'item-slot-modal-leftFinger',  'tooltip' => 'tooltip-leftFinger', 'GameIcon' => 'slotLeftFinger'),
    '11'     => array('modal' => 'item-slot-modal-rightFinger',  'tooltip' => 'tooltip-rightFinger', 'GameIcon' => 'slotRightFinger'),
    '12'     => array('modal' => 'item-slot-modal-leftTrinket',  'tooltip' => 'tooltip-leftTrinket', 'GameIcon' => 'slotLeftTrinket'),
    '13'     => array('modal' => 'item-slot-modal-rightTrinket',  'tooltip' => 'tooltip-rightTrinket', 'GameIcon' => 'slotRightTrinket'),
    '15'     => array('modal' => 'item-slot-modal-weapon',  'tooltip' => 'tooltip-weapon', 'GameIcon' => 'slotWeapon'),
    '16'     => array('modal' => 'item-slot-modal-offhand',  'tooltip' => 'tooltip-offhand', 'GameIcon' => 'slotOffhand')
);
@endphp
@foreach($item_slots_left as $slot => $data)
    @php
    $item_info = App\Services\Characters::GetEquippedItemInfo($slot);
    if($item_info['item_id']) {
        $tooltip = new App\Services\ItemPrototype();
        $tooltip->LoadItem($item_info['item_id']);
    }
    @endphp
    @if(!App\Services\Text::Exists(public_path('uploads/item/'.$item_info['icon'].'.jpg') ) )
        @php
        App\Services\Text::Download(
        'https://render-eu.worldofwarcraft.com/icons/56/'.$item_info['icon'].'.jpg',
        public_path('uploads/item/'.$item_info['icon'].'.jpg')
        )
        @endphp
    @endif
    @if(!$item_info || $item_info['item_id'] == 0)
        <div class="Tooltip" name="{{ $data['tooltip'] }}"><div class="GameTooltip"><div class="ui-tooltip">Пустая ячейка</div></div></div>
    @else

<div class="Tooltip" name="{{ $data['tooltip'] }}">
    <div class="GameTooltip">
        <div class="ui-tooltip">
            <div class="wiki-tooltip">
		        <span  class="icon-frame frame-56 " style='background-image: url("https://render-eu.worldofwarcraft.com/icons/56/inv_misc_kingsring2.jpg");'>
		    </span>
	    <h3 class="color-q{{ $item_info['quality'] }}">{{ $item_info['name'] }}</h3>
    <ul class="item-specs" style="margin: 0">
        @if($tooltip->Flags & 0x00000008)
        <li style="color:#00ff00"> Эпохальный</li>
        @endif
        @if($tooltip->Flags & 0x00000002)
        <li style="color:#00ff00"> Эпохальный</li>
        @endif
        <li class="color-tooltip-yellow">Уровень предмета {{ $item_info['item_level'] }}</li>
        @if($item_info['bonding'] > 0 && $item_info['bonding'] < 4)
        <li>@lang('inventory.template_item_bonding_' . $item_info['bonding'])</li>
        @endif
        @if($item_info['maxcount'] == 1)
        <li>Уникальный</li>
        @endif
        @if(in_array($tooltip->sub->Class, array(4, 2)))
        <li><span class="float-right">{{ $tooltip->subclass_name }}</span>@lang('inventory.template_item_invtype_' . $tooltip->InventoryType)</li>
        @endif
        @if($tooltip->sub->Class == 2)
        <li>
			<span class="float-right">Скорость {{ $tooltip->Delay }}</span>
        	1&nbsp;389 - 2&nbsp;318
        	Урон
		</li>

        <li>

        	(712,69 ед. урона в секунду)
        </li>
        @endif
	    @foreach($tooltip->ItemStat as $stat)
            @if($stat['type'] == 74 | $stat['type'] == 73 | $stat['type'] == 7 | $stat['type'] == 4 | $stat['type'] == 72)
                <li id="stat-{{ $stat['type'] }}">+<span>{{ $stat['value'] }}</span> @lang('inventory.template_item_stat_' . $stat['type'])</li>
            @endif
            @if($stat['type'] == 49 | $stat['type'] == 32 | $stat['type'] == 32 | $stat['type'] == 36 | $stat['type'] == 40)
            <li id="stat-{{ $stat['type'] }}" class="color-tooltip-green">+<span>{{ $stat['value'] }}</span> @lang('inventory.template_item_stat_' . $stat['type'])</li>
            @endif
        @endforeach

        <!--li>
				<ul class="item-specs">
						<li class="color-tooltip-green">Зачаровано: +200 к показателю скорости</li>

    										<li>
	<span class="icon-socket socket-type-7">
			<a href="/wow/ru/item/130248" class="gem">
				<img src="https://render-eu.worldofwarcraft.com/icons/18/inv_jewelcrafting_70_saberseye.jpg" alt="">
				<span class="frame"></span>
			</a>
	</span>
    											+200 к интеллекту
	<span class="clear"></span>
    										</li>
				</ul>
			</li-->
        @if($tooltip->sub->Class == 2)
        <li class="color-q2 item-spec-group">
            Если на персонаже:
            Предоставляет способность "Кристальные мечи", которая запускает в воздух парящие клинки, пронзающие ваших противников.
        </li>
        @endif
        @if($item_info['description'])
        <li class="color-tooltip-yellow">
		    "{{ $item_info['description'] }}"
		</li>
        @endif
        <li>
			<ul class="item-specs">
                @if($tooltip->AllowableClass > 0)
                    @php
                        $classes_data = \App\Services\Item::AllowableClasses($tooltip->AllowableClass);
                        if(is_array($classes_data)) {
                            $classes_text = '<li>';
                            $prev = false;
                            foreach($classes_data as $class_id => $class) {
                            $class_name = __('inventory.character_class_' . $class_id);
                            $t = explode(':', $class_name);
                            if(isset($t[1])) {
                                $class_name = $t[0];
                            }
                            if($prev) {
                                $classes_text .= ', ';
                            }
                            $classes_text .= sprintf(' <a href="%s/wow/game/class/%s" class="color-c%d">%s</a>', WoW::GetWoWPath(), $class['key'], $class_id, $class_name);
                            $prev = true;
                        }
                        $classes_text .= '</li>';
                        }
                    @endphp
                @endif

			    @if($item_info['requiredlevel'] > 1)
                <li>Требуется уровень {{ $item_info['requiredlevel'] }}</li>
                @endif
                @if($tooltip->SellPrice > 0) 
                @php
                    $sell_price = App\Services\ItemPrototype::getMoneyFormat($tooltip->SellPrice);
                    $sMoney = array('gold', 'silver', 'copper');
                @endphp
                <li>Цена продажи:
                @foreach($sMoney as $money)
                    <span class="icon-{{ $money }}">{{ $sell_price[$money] }}</span>
                @endforeach
				</li>
                @endif
            </ul>
        </li>
	</ul>
	<span class="clear"><!-- --></span>
</div></div></div></div>
@endif
@endforeach