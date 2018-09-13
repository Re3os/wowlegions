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
    @if (session('error'))
<div xmlns="http://www.w3.org/1999/xhtml" class="alert error closeable border-4 glow-shadow">
    <div class="alert-inner">
        <div class="alert-message">
            <p class="title"><strong><a name="form-errors">Исправьте, пожалуйста, следующее.</a></strong></p>
            <p>{{ session('error') }} </p>
        </div>
    </div>
</div>
@endif
@if (session('success'))
<div xmlns="http://www.w3.org/1999/xhtml" class="alert success closeable border-4 glow-shadow">
    <div class="alert-inner">
        <div class="alert-message">
            <p class="title"><strong><a name="form-errors">{{ session('success') }}</a></strong></p>
        </div>
    </div>
</div>
@endif
<div id="page-header">
<h2 class="subcategory">Список приглашённых</h2>
<h3 class="headline">Ваша история приглашённых друзей</h3>
</div>
<div id="page-content" class="page-content">
<div id="order-history">
<div class="data-container">
<table>
<div class="history">
<div id="order-history">
<div class="data-container">
<table cellpadding="0" cellspacing="0" border="0">
<thead>
<tr>
<th align="left" width="8%">Дата</th>
<th align="left" width="20%">E-Mail</th>
<th align="left" width="59%">Ник</th>
<th align="left" width="20%">Действие</th>
</tr>
</thead>
<tbody>
@foreach($history as $item)
<tr class="parent-row non-pointer">
<td valign="top" data-raw="{{ $item->created_at->format('YmdHm') }}">
<span><time datetime="{{ $item->created_at->format('Y-M-d') }}T{{ $item->created_at->format('H:m') }}+03:00">{{ $item->created_at->format('d M Y') }}</time></span>
</td>
<td valign="top">{{ $item->email }}</td>
<td valign="top"><strong>{{ $item->user[0]['name'] ?? 'unknown' }}</strong></td>
<td valign="top">
@if($item->complete)
    <strong>Использовано</strong>
@else
<strong><a href="{{ route('invite-select-characters', ['token' => $item->token, 'id' => $item->id]) }}">Получить награду</a> </strong>
@endif
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
<div class="clear"></div>
<ul class="paginator" id="pagelist"></ul>
</div>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection