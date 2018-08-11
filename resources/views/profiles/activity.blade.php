@extends('layouts.app')

@section('content')
<div class="Pane Pane--underSiteNav Pane--cropMax" data-url="//bnetcmsus-a.akamaihd.net/cms/template_resource/hf/HFUOF413X1O21459870154507.jpg">
    <div class="Pane-bg" style="background-color:#180906;background-image:url(&quot;//bnetcmsus-a.akamaihd.net/cms/template_resource/hf/HFUOF413X1O21459870154507.jpg&quot;);">
        <div class="Pane-overlay"></div>
    </div>
<div class="Pane-content">
    <div class="space-large" media-large="space-huge"></div>
    <div class="contain-max">
        <div class="font-semp-xLarge-white" media-large="font-semp-xxLarge-white">Активность пользователя {{ $profileUser->name }}</div>
        <div media-large="hide">
            <div class="space-normal"></div>
        <div class="font-semp-small-white">ElisGrimm</div>
        <div class="space-small"></div>
        <div class="List List--vertical">

        </div>
    </div>
<div class="hide" media-large="!hide">
    <div class="space-large"></div>
    <div class="font-semp-small-white text-upper">ElisGrimm</div>
    <div class="space-normal"></div>
    <div class="Grid Grid--gutters SyncHeight">
    @forelse ($activities as $date => $activity)
        <h3 class="page-header">{{ $date }}</h3>

        @foreach ($activity as $record)
            @if (view()->exists("profiles.activities.{$record->type}"))
                @include ("profiles.activities.{$record->type}", ['activity' => $record])
            @endif
        @endforeach
    @empty
        <p>There is no activity for this user yet.</p>
    @endforelse
</div></div></div><div class="space-normal" media-large="space-large"></div></div></div><div class="Divider"></div>
 @endsection