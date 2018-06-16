@extends('layouts.app')

@section('content')
<div class="Pane Pane--cropMax Pane--underSiteNav Pane--noInnerSpacing">
    <div class="Pane-bg" style="background-color:#04100a;">
        <div class="Pane-overlay"></div>
    </div>
    <div class="Pane-content">
        <div class="space-medium"></div>
    <div class="contain-max">
        <div class="gutter-normal" media-wide="!gutter-normal gutter-large">
        @include('characters.block.space-bar')
    <div class="space-small"></div>
    @include('characters.block.menu')

<div class="space-small"></div>
<div class="Divider Divider--opaque Divider--thin"></div>
</div>
</div>
<div class="space-normal"></div>
<div class="contain-max">
<div class="gutter-normal" media-wide="!gutter-normal gutter-large">
<div class="contain-huge">
<div class="CharacterProfile">
    <div class="CharacterProfile-render">
        <div class="Art CharacterProfile-bg" style="margin-top:-48.93617021276596%;margin-right:-77.6595744680851%;margin-bottom:-21.27659574468085%;margin-left:-77.6595744680851%;width:255.31914893617022%;">
            <div class="Art-size" style="padding-top:77.5%"></div>
            <div class="Art-image" style="background-image:url(https://bnetcmsus-a.akamaihd.net/cms/template_resource/KTBDECLHH8WI1479495659687.jpg);"></div>
            <div class="Art-overlay"></div>
        </div>
        <div class="Art CharacterProfile-image" style="margin-right:-35.1063829787234%;margin-left:-35.1063829787234%;width:170.2127659574468%;" data-fallback="https://bnetcmsus-a.akamaihd.net/cms/template_resource/KTBDECLHH8WI1479495659687.jpg">
            <div class="Art-size" style="padding-top:75%"></div>
            <div class="Art-image" style="background-image:url(https://bnetcmsus-a.akamaihd.net/cms/template_resource/KTBDECLHH8WI1479495659687.jpg);"></div>
            <div class="Art-overlay"></div>
        </div>
    </div>

<div class="CharacterProfile-gear CharacterProfile-gear--left">
@php
$item_slots_left = array(
    '0'      => array('modal' => 'item-slot-modal-head',  'tooltip' => 'tooltip-head', 'GameIcon' => 'slotHead'),
    '1'      => array('modal' => 'item-slot-modal-neck',  'tooltip' => 'tooltip-neck', 'GameIcon' => 'slotNeck'),
    '2'      => array('modal' => 'item-slot-modal-shoulder',  'tooltip' => 'tooltip-shoulder', 'GameIcon' => 'slotShoulder'),
    '14'     => array('modal' => 'item-slot-modal-back',  'tooltip' => 'tooltip-back', 'GameIcon' => 'slotBack'),
    '4'      => array('modal' => 'item-slot-modal-chest',  'tooltip' => 'tooltip-chest', 'GameIcon' => 'slotChest'),
    '3'      => array('modal' => 'item-slot-modal-shirt',  'tooltip' => 'tooltip-shirt', 'GameIcon' => 'slotShirt'),
    '18'     => array('modal' => 'item-slot-modal-tabard',  'tooltip' => 'tooltip-tabard', 'GameIcon' => 'slotTabard'),
    '8'      => array('modal' => 'item-slot-modal-wrist',  'tooltip' => 'tooltip-wrist', 'GameIcon' => 'slotWrist')
);
@endphp
@foreach($item_slots_left as $slot => $data)
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
        <div class="CharacterProfile-item">
            <a class="Link Link--block" data-modal="{{ $data['modal'] }}" data-modal-analytics-type="Item" data-tooltip="{{ $data['tooltip'] }}">
                <div>
                    <div class="GameIcon GameIcon--slot CharacterProfile-itemSlot GameIcon--{{ $data['GameIcon'] }}" media-wide="GameIcon--large">
                        <div class="GameIcon-icon"></div>
                        <div class="GameIcon-transmog"></div>
                    </div>
                </div>
            </a>
        </div>
    @else
    <div class="CharacterProfile-item">
        <a class="Link Link--block" data-modal="{{ $data['modal'] }}" data-modal-analytics-type="Item" data-tooltip="{{ $data['tooltip'] }}">
            <div>
                <div class="GameIcon GameIcon--@lang('inventory.color-quality-' . $item_info['quality']) GameIcon--slot CharacterProfile-itemIcon CharacterProfile-itemSlot" media-wide="GameIcon--large">
                    <div class="GameIcon-icon" style="background-image:url(&quot;{{ asset('uploads/item/'.$item_info['icon']) }}.jpg&quot;);">

                    </div>
                    <div class="GameIcon-transmog"></div>
                </div>
                <div class="CharacterProfile-itemDetails">
                    <div class="CharacterProfile-itemName color-quality-@lang('inventory.color-quality-' . $item_info['quality'])">{{ $item_info['name'] }}</div>
                    <div class="List List--left List--guttersTiny">
                        <div class="List-item CharacterProfile-itemLevel">{{ $item_info['item_level'] }}</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    @endif
@endforeach
</div>
<div class="CharacterProfile-gear CharacterProfile-gear--right">
@php
$item_slots_left = array(
    '9'      => array('modal' => 'item-slot-modal-hand',  'tooltip' => 'tooltip-hand', 'GameIcon' => 'slotHand'),
    '5'      => array('modal' => 'item-slot-modal-waist',  'tooltip' => 'tooltip-waist', 'GameIcon' => 'slotWaist'),
    '6'      => array('modal' => 'item-slot-modal-leg',  'tooltip' => 'tooltip-leg', 'GameIcon' => 'slotLeg'),
    '7'      => array('modal' => 'item-slot-modal-foot',  'tooltip' => 'tooltip-foot', 'GameIcon' => 'slotFoot'),
    '10'     => array('modal' => 'item-slot-modal-leftFinger',  'tooltip' => 'tooltip-leftFinger', 'GameIcon' => 'slotLeftFinger'),
    '11'     => array('modal' => 'item-slot-modal-rightFinger',  'tooltip' => 'tooltip-rightFinger', 'GameIcon' => 'slotRightFinger'),
    '12'     => array('modal' => 'item-slot-modal-leftTrinket',  'tooltip' => 'tooltip-leftTrinket', 'GameIcon' => 'slotLeftTrinket'),
    '13'     => array('modal' => 'item-slot-modal-rightTrinket',  'tooltip' => 'tooltip-rightTrinket', 'GameIcon' => 'slotRightTrinket')
);
@endphp
@foreach($item_slots_left as $slot => $data)
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
        <div class="CharacterProfile-item">
            <a class="Link Link--block" data-modal="{{ $data['modal'] }}" data-modal-analytics-type="Item" data-tooltip="{{ $data['tooltip'] }}">
                <div>
                    <div class="GameIcon GameIcon--slot CharacterProfile-itemSlot GameIcon--{{ $data['GameIcon'] }}" media-wide="GameIcon--large">
                        <div class="GameIcon-icon"></div>
                        <div class="GameIcon-transmog"></div>
                    </div>
                </div>
            </a>
        </div>
    @else
    <div class="CharacterProfile-item">
        <a class="Link Link--block" data-modal="{{ $data['modal'] }}" data-modal-analytics-type="Item" data-tooltip="{{ $data['tooltip'] }}">
            <div>
                <div class="GameIcon GameIcon--@lang('inventory.color-quality-' . $item_info['quality']) GameIcon--slot CharacterProfile-itemIcon CharacterProfile-itemSlot" media-wide="GameIcon--large">
                    <div class="GameIcon-icon" style="background-image:url(&quot;{{ asset('uploads/item/'.$item_info['icon']) }}.jpg&quot;);"></div>
                    <div class="GameIcon-transmog"></div>
                </div>
                <div class="CharacterProfile-itemDetails">
                    <div class="CharacterProfile-itemName color-quality-@lang('inventory.color-quality-' . $item_info['quality'])">{{ $item_info['name'] }}</div>
                    <div class="List List--right List--guttersTiny">
                        <div class="List-item CharacterProfile-itemLevel">{{ $item_info['item_level'] }}</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    @endif
@endforeach
</div>

<div class="CharacterProfile-gear CharacterProfile-gear--bottom">
@php
$item_slots_left = array(
    '15'   => array('modal' => 'item-slot-modal-weapon',  'tooltip' => 'tooltip-weapon', 'GameIcon' => 'slotWeapon'),
    '16'   => array('modal' => 'item-slot-modal-offhand',  'tooltip' => 'tooltip-offhand', 'GameIcon' => 'slotOffhand')
);
@endphp
@foreach($item_slots_left as $slot => $data)
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
        <div class="CharacterProfile-item"><a class="Link Link--block" data-modal="{{ $data['modal'] }}" data-modal-analytics-type="Item" data-tooltip="{{ $data['tooltip'] }}"><div><div class="GameIcon GameIcon--slot CharacterProfile-itemSlot GameIcon--{{ $data['GameIcon'] }}" media-wide="GameIcon--large"><div class="GameIcon-icon"></div><div class="GameIcon-transmog"></div></div></div></a></div>
    @else
    <div class="CharacterProfile-item"><a class="Link Link--block" data-modal="item-slot-modal-weapon" data-modal-analytics-type="Item" data-tooltip="tooltip-weapon"><div><div class="GameIcon GameIcon--@lang('inventory.color-quality-' . $item_info['quality']) GameIcon--slot CharacterProfile-itemIcon CharacterProfile-itemSlot" media-wide="GameIcon--large"><div class="GameIcon-icon" style="background-image:url(&quot;{{ asset('uploads/item/'.$item_info['icon']) }}.jpg&quot;);"></div><div class="GameIcon-transmog"></div></div><div class="CharacterProfile-itemDetails"><div class="CharacterProfile-itemName color-quality-@lang('inventory.color-quality-' . $item_info['quality'])">{{ $item_info['name'] }}</div><div class="List List--right List--guttersTiny"><div class="List-item CharacterProfile-itemLevel">{{ $item_info['item_level'] }}</div></div></div></div></a></div>
    @endif
@endforeach
</div>

<div class="CharacterProfile-tooltips">
    @include('characters.tooltips.tooltips')
</div>

</div>
</div>
<div class="space-normal"></div><div class="space-small"></div><div class="space-normal"></div><div class="space-small"></div>
<div class="position-relative"><div class="CharacterProfileRenderExportLink position-right"><a class="Link Link--text" href="" download="Кенджай.jpg" data-analytics="export-character-image"><span class="Icon Icon--character-download Icon--small"><svg class="Icon-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64"><use xlink:href="/static/components/Icon/Icon.svg#character-download"></use></svg></span><span>Сохранить изображение персонажа</span></a></div></div>
<div class="space-medium"></div>
<div class="Divider Divider--thin Divider--opaque"></div>
<div class="space-medium"></div>
@include('characters.block.summary_stats', ['char' => $char])
<div class="space-medium"></div>
<!--div class="Divider Divider--thin Divider--opaque"></div>
<div class="space-medium"></div>
<div media-medium="hide">
    <div class="font-semp-small-white text-upper inline">Таланты специализации</div>
    @include('characters.block.talents_bild_0')
</div>
@include('characters.block.talents_bild_1')
<div class="space-medium"></div>
<div class="Divider Divider--thin Divider--opaque"></div>
<div class="space-medium"></div><div class="font-semp-small-white text-upper inline">Рейдовый прогресс в Legion</div>
<a class="Link" href="/ru-ru/character/deathguard/людейел/pve">
    <div class="font-bliz-light-xSmall-lightGold inline gutter-small">Просмотреть журнал рейдов</div>
</a>
<div class="space-normal"></div>
@include('characters.block.reids')
<div class="space-medium"></div-->
<div class="Divider Divider--thin Divider--opaque"></div>
<div class="space-medium"></div>
<div class="font-semp-small-white text-upper inline">PvP</div>
<a class="Link" href="{{ route('characters-pvp', [$char->name ]) }}">
    <div class="font-bliz-light-xSmall-lightGold inline gutter-small">Просмотреть подробную PvP-статистику</div>
</a>
<div class="space-normal"></div>
@include('characters.block.pvp')
<div class="space-medium"></div>
</div>
</div>
</div>
</div>
<div class="Divider"></div>
@endsection