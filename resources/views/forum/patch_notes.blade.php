@extends('layouts.forum')

@section('body') patch-notes @endsection

@section('sidebar')
<div class="Breadcrumbs"> <span class="Breadcrumb"> <a href="{{ route('forums') }}" class="Breadcrumb-content">
<span class="Breadcrumb-divider Home"> <i class="Icon"></i> </span> @lang('navbar.Navbar-forums') </a> </span> <span class="Breadcrumb"> <span class="Breadcrumb-divider"> <i class="Icon"></i> </span> <a href="{{ route('patch-notes') }}" class="Breadcrumb-content is-active"> Список изменений </a> </span></div>
@endsection

@section('og')
<meta property="og:type" content="website" />
<meta property="og:url" content="{{ route('forums') }}" />
<meta property="og:title" content="@yield('title') {{ config('app.name_forum', __('forum.title')) }}" />
<meta property="og:image" content="{{ asset_media('/forums/static/images/social-thumbs/wow.png') }}" />
<meta property="og:description" content="@lang('forum.description')" />
@endsection

@section('content')
<section class="Scm-content">
<div class="section">
<h2>Список изменений</h2>

<p>Команда разработчиков форума благодарит вас за ваши отзывы!</p>
<a class="PatchNotes-button--feedback" href="{{ route('forum.topic', [59])}}">Отправить Отзыв</a></div>
@foreach($pathNotes as $item)
<div class="section">
<h3>{{ $item->path }} - {{ $item->created_at->format('d M Y') }}</h3>

<!--div class="PatchNotes-statusTag improvements"><span class="PatchNotes-statusTagContent">Improved</span></div>
<div class="PatchNotes-statusTag newFeatures"><span class="PatchNotes-statusTagContent">New!</span></div-->
{!! $item->text !!}
</div>
@endforeach
</section>
@endsection