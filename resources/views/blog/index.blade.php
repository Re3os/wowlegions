@extends('layouts.app')

@section('content')
<div class="Pane Pane--full Pane--dirtDark" queryselectoralways="33">
    <div class="Pane-bg">
        <div class="Pane-overlay"></div>
    </div>
    <div class="Pane-content">
        <div class="Pane Pane--underSiteNav Pane--cropMax Pane--transparent" data-url="//bnetcmsus-a.akamaihd.net/cms/template_resource/ri/RI8Q9HOWY4U01465961118458.jpg" queryselectoralways="33">
            <div class="Pane-bg" style="background-image:url(&quot;//bnetcmsus-a.akamaihd.net/cms/template_resource/ri/RI8Q9HOWY4U01465961118458.jpg&quot;);">
                <div class="Pane-overlay"></div>
            </div>
            <div class="Pane-content">
                <div class="space-medium"></div>

                <div class="Grid SyncHeight gutter-small gutter-all gutter-negative" media-medium="!SyncHeight--disabled" queryselectoralways="0 45" media-original="Grid SyncHeight SyncHeight--disabled gutter-small gutter-all gutter-negative">
                    @foreach($featured as $item)
                    <div class="ArticleTile ArticleTile--gutter Grid-full Grid-1of3" media-small="Grid-full" media-medium="Grid-1of2" media-wide="!Grid-1of2 Grid-1of3" queryselectoralways="0" media-original="ArticleTile ArticleTile--gutter"><div class="ArticleTile-content"><div class="Tile ArticleTile-tile"><div class="Tile-area"><div class="Tile-bg" style="background-image:url(&quot;{{ asset('uploads/images/'.$item->images) }}&quot;);"></div><div class="Tile-content"></div></div></div><div class="ArticleTile-fade"></div><div class="ArticleTile-play"><div class="ArticleTile-playArrow"></div></div><div class="ArticleTile-bottom"><div class="ArticleTile-bottomInner"><div class="ArticleTile-left"><div class="ArticleTile-subtitle">Последние изменения в игре. Узнайте больше!</div><div class="ArticleTile-title">{{ $item->title }}</div></div><div class="ArticleTile-right"><div class="ArticleTile-commentTotal List-right"><a class="Link ArticleTile-comments" href="{{ route('news.show', ['id' => $item->id, \App\Services\Text::createSlug($item->title) ]) }}#comments" data-analytics="panel-news" data-analytics-panel="slot:5 - type:blog - id:{{ $item->id }} || {{ $item->title }}"><div class="CommentTotal CommentTotal--horizontal CommentTotal--right ArticleTile-commentTotal"><span class="Icon Icon--comment Icon--small CommentTotal-icon"><svg class="Icon-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64"><use xlink:href="/static/components/Icon/Icon.svg#comment"></use></svg></span><div class="CommentTotal-number">{{ App\Comment::where('post_id', $item->id)->count() }}</div></div></a></div></div></div></div><a class="Link ArticleTile-link" href="{{ route('news.show', ['id' => $item->id, \App\Services\Text::createSlug($item->title) ]) }}" data-thumb="{{ asset('uploads/images/'.$item->images) }}" data-analytics="panel-news" data-analytics-panel="slot:5 - type:blog - id:{{ $item->id }} || {{ $item->title }}"></a></div></div>
                    @endforeach
                </div>
<div class="space-normal"></div>
<div class="space-medium"></div>
<div class="Pane Pane--transparent" queryselectoralways="33">
<div class="Pane-bg">
<div class="Pane-overlay"></div>
</div>
<div class="Pane-content">
<div class="gutter-normal gutter-negative">
<div class="Pagination" data-url="/ru-ru/news.frag" data-page="1" data-total="18" queryselectoralways="32">
<div class="Pagination-pages">
<div class="Pagination-page" data-page="1">
<div class="List List--vertical List--separatorAll List--full">
@foreach($blog as $item)
<div class="List-item">
    <div class="NewsBlog"><div class="NewsBlog-content"><div class="Grid Grid--gutter"><div class="Grid-col Grid-1of4 Grid-1of5" media-large="!hide Grid-1of4" media-wide="Grid-1of5" queryselectoralways="0" media-original="Grid-col hide"><a class="Link" href="{{ route('news.show', ['id' => $item->id, \App\Services\Text::createSlug($item->title) ]) }}"><div class="Tile Tile--border NewsBlog-tile"><div class="Tile-area"><div class="Tile-bg" style="background-image:url(&quot;{{ asset('uploads/images/'.$item->images) }}&quot;);"></div><div class="Tile-content"></div></div></div></a></div><div class="Grid-full gutter-small Grid-3of4 Grid-4of5" media-large="Grid-3of4" media-wide="Grid-4of5" queryselectoralways="0" media-original="Grid-full gutter-small"><div class="contain-large contain-left gutter-normal" media-large="gutter-normal" queryselectoralways="0" media-original="contain-large contain-left"><div class="NewsBlog-title">{{ $item->title }}</div><p class="NewsBlog-desc color-beige-medium font-size-xSmall">{{ $item->desc_blog }}</p></div><div media-large="gutter-normal" queryselectoralways="0" media-original="" class="gutter-normal"><div class="Pair"><div class="Pair-left"><div class="List NewsBlog-details"><div class="List-item NewsBlog-comments"><a class="Link" href="{{ route('news.show', ['id' => $item->id, \App\Services\Text::createSlug($item->title) ]) }}#comments"><div class="CommentTotal CommentTotal--horizontal CommentTotal--beigeDark CommentTotal--transition"><span class="Icon Icon--comment Icon--small CommentTotal-icon"><svg class="Icon-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64"><use xlink:href="/static/components/Icon/Icon.svg#comment"></use></svg></span><div class="CommentTotal-number">{{ App\Comment::where('post_id', $item->id)->count() }}</div></div></a></div><div class="List-item NewsBlog-published"><div class="gutter-normal color-beige-dark font-size-xxSmall">{{ $item->created_at->format('d M Y') }}</div></div></div></div></div></div></div></div></div><a class="Link NewsBlog-link" href="{{ route('news.show', ['id' => $item->id, \App\Services\Text::createSlug($item->title) ]) }}"></a></div></div>
@endforeach
</div>
</div>
</div>
{{ $blog->links('blog.paginate') }}
</div>
<div class="space-large"></div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection