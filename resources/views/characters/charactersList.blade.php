@extends('layouts.app')

@section('content')
<div class="Pane Pane--underSiteNav Pane--cropMax" data-url="{{ asset_media('/cms/template_resource/hf/HFUOF413X1O21459870154507.jpg') }}">
    <div class="Pane-bg" style="background-color:#180906;background-image:url(&quot;{{ asset_media('/cms/template_resource/hf/HFUOF413X1O21459870154507.jpg') }}&quot;);">
        <div class="Pane-overlay"></div>
    </div>
<div class="Pane-content">
    <div class="space-large" media-large="space-huge"></div>
    <div class="contain-max">
        <div class="font-semp-xLarge-white" media-large="font-semp-xxLarge-white">Персонажи</div>
        <div media-large="hide">
            <div class="space-normal"></div>
        <div class="font-semp-small-white">ElisGrimm</div>
        <div class="space-small"></div>
        <div class="List List--vertical">
            @foreach($char as $item)
            <div class="List-item">
                <a class="Link Character Character--@lang('forum.class_key_'.$item->class) Character--avatar Character--level Character--onDark Character--small Character--square" href="{{ route('characters', [$item->name]) }}">
                    <div class="Character-table">
                        <div class="Character-bust"><div class="Art Art--above"><div class="Art-size" style="padding-top:50.43478260869565%"></div><div class="Art-image" style="background-image:url({{ asset('/uploads/avatar/'.Auth::user()->avatar) }});"></div><div class="Art-overlay"></div></div></div><div class="Character-avatar"><div class="Avatar Avatar--medium"><div class="Avatar-image" style="background-image:url(&quot;{{ asset('/uploads/avatar/'.Auth::user()->avatar) }}&quot;);"></div></div></div>
                        <div class="Character-details">
                            <div class="Character-role"></div>
                            <div class="Character-name">{{ $item->name }}</div>
                            <div class="Character-level"><b>{{ $item->level }}</b> @lang('forum.class_'.$item->class) <!--(Стрельба)--></div>
                            <div class="Character-realm">ElisGrimm</div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
<div class="hide" media-large="!hide">
    <div class="space-large"></div>
    <div class="font-semp-small-white text-upper">ElisGrimm</div>
    <div class="space-normal"></div>
    <div class="Grid Grid--gutters SyncHeight">
@foreach($char as $item)
<div class="Grid-1of2 SyncHeight-item" media-wide="Grid-1of3" media-huge="Grid-1of4"><a class="Link Character Character--@lang('forum.class_key_'.$item->class) Character--avatar Character--level Character--onDark Character--square" href="{{ route('characters', [$item->name]) }}"><div class="Character-table"><div class="Character-bust"><div class="Art Art--above"><div class="Art-size" style="padding-top:50.43478260869565%"></div><div class="Art-image" style="background-image:url({{ asset('/uploads/avatar/'.Auth::user()->avatar) }});"></div><div class="Art-overlay"></div></div></div><div class="Character-avatar"><div class="Avatar"><div class="Avatar-image" style="background-image:url(&quot;{{ asset('/uploads/avatar/'.Auth::user()->avatar) }}&quot;);"></div></div></div><div class="Character-details"><div class="Character-role"></div><div class="Character-name">{{ $item->name }}</div><div class="Character-level"><b>{{ $item->level }}</b> @lang('forum.class_'.$item->class) <!--(Стрельба)--></div><div class="Character-realm">ElisGrimm</div></div></div></a></div>
 @endforeach
</div></div></div><div class="space-normal" media-large="space-large"></div></div></div><div class="Divider"></div>
 @endsection