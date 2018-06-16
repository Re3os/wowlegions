@extends('layouts.app')

@section('content')
<div class="Pane Pane--underSiteNav Pane--cropEdge" data-url="/cms/template_resource/90/90GADAMBLMYV1466177710309.jpg" queryselectoralways="33">
    <div class="Pane-bg" style="background-color:#090c1d;background-image:url(&quot;/cms/template_resource/90/90GADAMBLMYV1466177710309.jpg&quot;);">
        <div class="Pane-overlay"></div>
    </div>
        <div class="Pane-content">
            <div class="space-huge"></div>
            <div class="contain-masthead align-center">
                <div class="font-semp-xxLarge-white">Состояние игрового мира</div>
                <div class="space-rhythm-medium"></div>
                <div class="Content font-bliz-light-small-beige">
                    <div media-large="hide" queryselectoralways="0" media-original="" class="hide">На этой странице перечислены все игровые миры World of Warcraft с указанием, какой мир открыт или закрыт. О текущем состоянии игровых миров и  техобслуживании сообщается на <a href="{{ route('forums') }}">форуме</a>. Если ваш игровой мир сейчас закрыт, будьте уверены: мы об этом знаем и делаем все возможное, чтобы поскорее его открыть.</div>
                <div class="" media-large="!hide" queryselectoralways="0" media-original="hide">На этой странице перечислены все игровые миры World of Warcraft с указанием, какой мир в данный момент открыт, а какой закрыт. О текущем состоянии игровых миров и предстоящем техобслуживании сообщается на <a href="{{ route('forums') }}">форуме</a>. Если ваш игровой мир сейчас закрыт, будьте уверены: мы об этом знаем и делаем все возможное, чтобы поскорее его открыть.</div></div></div><div class="space-normal space-medium space-huge" media-large="space-medium" media-wide="space-huge" queryselectoralways="0" media-original="space-normal"></div>

<div class="SortTable SortTable--flex SortTable--ghost" queryselectoralways="43" style=""><div class="SortTable-head"><div class="SortTable-row"><div class="SortTable-col SortTable-label align-center" data-priority="2"><div class="SortTable-labelOuter"><div class="SortTable-labelInner"><div class="SortTable-labelText">Состояние</div></div></div></div><div class="SortTable-col SortTable-label align-center is-sorted-reverse" data-priority="1"><div class="SortTable-labelOuter"><div class="SortTable-labelInner"><div class="SortTable-labelText">Название мира</div></div></div></div><div class="SortTable-col SortTable-label align-center" data-priority="5"><div class="SortTable-labelOuter"><div class="SortTable-labelInner"><div class="SortTable-labelText">Тип</div></div></div></div><div class="SortTable-col SortTable-label align-center" data-priority="4"><div class="SortTable-labelOuter"><div class="SortTable-labelInner"><div class="SortTable-labelText">Заселенность</div></div></div></div><div class="SortTable-col SortTable-label align-center" data-priority="7"><div class="SortTable-labelOuter"><div class="SortTable-labelInner"><div class="SortTable-labelText">Часовой пояс</div></div></div></div><div class="SortTable-col SortTable-label align-center" data-priority="6"><div class="SortTable-labelOuter"><div class="SortTable-labelInner"><div class="SortTable-labelText">Страна</div></div></div></div></div></div>

<div class="SortTable-body">
    <div class="SortTable-row">
        <div class="SortTable-col SortTable-data text-nowrap align-center" data-value="0">
            <span class="Icon Icon--{!! $server->status ? 'checkCircleGreen' : 'closeCircleRed' !!} SortTable-status"></span>
        </div>
        <div class="SortTable-col SortTable-data text-nowrap align-center">{{ $server->name }}</div>
        <div class="SortTable-col SortTable-data text-nowrap type align-center">(PvP)</div>
        <div class="SortTable-col SortTable-data text-nowrap align-center" data-value="1">Низкая</div>
        <div class="SortTable-col SortTable-data text-nowrap align-center">CEST</div>
        <div class="SortTable-col SortTable-data text-nowrap align-center">Россия и СНГ</div>
    </div>
</div>
</div><div class="space-normal space-medium space-huge" media-large="space-medium" media-wide="space-huge" queryselectoralways="0" media-original="space-normal"></div></div></div>
@endsection