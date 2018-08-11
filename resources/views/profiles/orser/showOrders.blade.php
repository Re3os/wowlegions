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
<h2 class="subcategory">Операции</h2>
<h3 class="headline">История заказов</h3>
</div>
<div id="page-content" class="page-content">
<div id="order-controls" class="order-controls">
<div class="order-region" id="order-region-payment">
<label for="orderRegion">Регион:</label>
<div class="ui-dropdown" id="region-dropdown2">
<select name="orderRegion" id="orderRegion">
<option value="2" selected="selected">Европа</option>
</select>
</div>
</div>
</div>
<span class="clear"><!-- --></span>
<div id="order-history">
<div class="data-container">
<table>
<thead>
<tr>
<th align="left" width="8%"><a href="#" class="sort-link numeric"><span class="arrow down">Дата</span></a></th>
<th align="center" width="42%">Наименование</th>
<th align="center" width="5%">Цена</th>
<th align="center" width="5%">Количество</th>
<th align="center" width="9%"><a href="#" class="sort-link"><span class="arrow">Состояние</span></a></th>
<th align="center" width="13%"><a href="#" class="sort-link numeric"><span class="arrow">Итого</span></a></th>
</tr>
</thead>
<tbody>
@foreach($history as $item)
<tr class="parent-row " data-click="order-detail.html?rId=2&amp;oId=299723298">
<td valign="top" data-raw="{{ $item->created_at->format('YmdHm') }}">
<span><time datetime="{{ $item->created_at->format('Y-M-d') }}T{{ $item->created_at->format('H:m') }}+03:00">{{ $item->created_at->format('d M Y') }}</time></span>
</td>
<td valign="top">
<strong data-service-id="FLEXIBLE_LICENSE">{{ $item['item_name'] }}</strong>
</td>
<td valign="top" class="align-right item-price">{{ $item['price'] }} РУБ</td>
<td valign="top" class="align-center">1</td>
<td valign="top" class="align-center status-success">Выполнен</td>
<td valign="top" class="align-right" data-raw="{{ $item['price'] }}">{{ $item['price'] }} РУБ</td>
</tr>
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
<script type="text/javascript">
//<![CDATA[
$(function() {
$('#region-dropdown2').dropdown({
callback: function(dropdown, selected) {
var test = $("#view-dropdown2").find("select option:selected").val();
location.href = 'orders.html?rId='+ selected;
},
updateText: false
});
$('#view-dropdown2').dropdown({
callback: function(dropdown, selected) {
switch (selected) {
case "1":
selected = "";
break;
case "2":
selected = "chargeback";
break;
}
orderTable.filter('class', 'class', selected);
},
updateText: true
});
var orderTable = DataSet.factory('#order-history');
$('#order-history tr').hover(function() {
var activeRow = $(this);
activeRow.addClass('row-hover');
activeRow.nextUntil('.parent-row').addClass('row-hover');
if (activeRow.hasClass('child-row')) {
activeRow.prevUntil('.parent-row').addClass('row-hover');
activeRow.prevAll('.parent-row').eq(0).addClass('row-hover');
}
},function() {
$('#order-history tr').removeClass('row-hover');
});
});
//]]>
</script>
</div>
</div>
</div>
@endsection