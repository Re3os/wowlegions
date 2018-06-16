<div class="summary-top-inventory">
<div id="summary-inventory" class="summary-inventory summary-inventory-simple">
@php
$item_slots = array(
    '0'      => array('slot' => 1,  'style' => ' left: 0px; top: 0px;'),
    '1'      => array('slot' => 2,  'style' => ' left: 0px; top: 58px;'),
    '2' => array('slot' => 3,  'style' => 'left: 0px; top: 116px;'),
    '14'      => array('slot' => 16, 'style' => ' left: 0px; top: 174px;'),
    '4'     => array('slot' => 5,  'style' => ' left: 0px; top: 232px;'),
    '3'      => array('slot' => 4,  'style' => ' left: 0px; top: 290px;'),
    '18'    => array('slot' => 19, 'style' => ' left: 0px; top: 348px;'),
    '8'    => array('slot' => 9,  'style' => ' left: 0px; top: 406px;'),
    '9'     => array('slot' => 10, 'style' => ' top: 0px; right: 0px;'),
    '5'     => array('slot' => 6,  'style' => ' top: 58px; right: 0px;'),
    '6'      => array('slot' => 7,  'style' => ' top: 116px; right: 0px;'),
    '7'      => array('slot' => 8,  'style' => ' top: 174px; right: 0px;'),
    '10'   => array('slot' => 11, 'style' => ' top: 232px; right: 0px;'),
    '11'   => array('slot' => 11, 'style' => ' top: 290px; right: 0px;'),
    '12'  => array('slot' => 12, 'style' => ' top: 348px; right: 0px;'),
    '13'  => array('slot' => 12, 'style' => ' top: 406px; right: 0px;'),
    '15'  => array('slot' => 21, 'style' => ' left: 273.5px; bottom: 0px;'),
    '16'   => array('slot' => 22, 'style' => ' left: 338.5px; bottom: 0px;')
);
@endphp

@foreach($item_slots as $slot => $data)
    @php
    $item_info = App\Services\Characters::GetEquippedItemInfo($slot);
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
        <div data-id="{{ $data['slot']-1 }}" data-type="{{ $data['slot'] }}" class="slot slot-{{ $data['slot'] }}" style="{{ $data['style'] }}">
        <div class="slot-inner">
        <div class="slot-contents"><a href="javascript:;" class="empty"><span class="frame"></span></a>
        </div>
        </div>
        </div>
    @else
        <div data-id="{{ $data['slot']-1 }}" data-type="{{ $data['slot'] }}" class="slot slot-{{ $data['slot'] }} @if($slot >= 9 && $slot <= 15) slot-align-right @endif item-quality-{{ $item_info['quality'] }}" style="{{ $data['style'] }}">
        <div class="slot-inner">
        <div class="slot-contents"><a href="{{ route('item-view', ['id' => $item_info['item_id']]) }}" class="item" data-item="{{ $item_info['item_id'] }}" data-tooltip="#tooltip-0">
        <img src="{{ asset('uploads/item/'.$item_info['icon']) }}.jpg" alt="" />
        <span class="frame"></span></a>
        <!--a class="transmog-frame" data-item="t=%d&amp;cc=0" href="/item/%d"></a-->
        </div>
        </div>
        </div>
    @endif
@endforeach
</div>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
var summaryInventory = new Summary.Inventory({ view: "simple" }, {

@if($item_slots)
@foreach($item_slots as $slot => $style)
    @php
    $item_info = App\Services\Characters::GetEquippedItemInfo($slot);
    @endphp
    {{ $slot }} : {
    name: "{{ $item_info['name'] }}",
    quality: "{{ $item_info['quality'] }}",
    icon: "{{ $item_info['icon'] }}"
    },
@endforeach
@endif
});
});
//]]>
</script>
</div>