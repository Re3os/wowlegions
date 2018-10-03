@extends('layouts.account')

@section('css')
<link rel="stylesheet" type="text/css" media="all" href="{{ asset_media('/account/static/css/management/order-history.4HmUU.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset_media('/account/static/css/management/services.263qz.css') }}" />
<!--[if IE 6]>
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset_media('/account/static/css/management/services-ie6.16uAc.css') }}" />
<![endif]-->
@endsection

@section('js')
<script type="text/javascript" src="{{ asset_media('/account/static/local-common/js/utility/dropdown.28tgo.js') }}"></script>
<script type="text/javascript" src="{{ asset_media('/account/static/local-common/js/utility/dataset.4NBTd.js') }}"></script>
@endsection

@section('content')
<div id="layout-middle">
<div class="wrapper">
<div id="content">
<div id="page-header">
<h2 class="subcategory">Голосование</h2>
<h3 class="headline">Система голосования</h3>
</div>
<div id="page-content" class="page-content">
<span class="clear"><!-- --></span>
<div id="order-history">
<div class="data-container">
<table>
<thead>
<tr>
<th align="left" width="25%">Рейтинг</th>
<th align="center" width="25%">Награда</th>
<th align="center" width="25%">Состояние</th>
</tr>
</thead>
<tbody>@foreach($top as $item)
@if($check <= $data)
<tr class="parent-row " data-click="{{ route('vote-action', ['vote' => $item->id]) }}">
<td valign="top">
<strong data-service-id="FLEXIBLE_LICENSE">{{ $item->topname }}</strong>
</td>
<td valign="top" class="align-center item-price">{{ $item->reward }} РУБ</td>
<td valign="top" class="align-center">Проголосовать</td></tr>
@else
<tr class="parent-row ">
<td valign="top">
<strong data-service-id="FLEXIBLE_LICENSE">{{ $item->topname }}</strong>
</td>
<td valign="top" class="align-center item-price">{{ $item->reward }} РУБ</td>
<td valign="top" class="align-center">Вы сможете голосовать {{ date("j M G:i", $check) }}</td></tr>
@endif
@endforeach
</tbody>
<script>
$(function() {
$('[data-click]').on('mousedown', 'td', function(e) {
$(this).data('clickstart', e.timeStamp);
});
$('[data-click]').on('mouseup', 'td', function(e) {
// bail on right click or modified click
if(e.which != 1 || e.metaKey || e.ctrlKey || e.altKey) {
return false;
}
// Speed of click... this way selection can happen
if(e.timeStamp - $(this).data('clickstart') > 500) {
return false;
}
document.location.href = $(this).closest('[data-click]').data('click');
});
});
</script>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection