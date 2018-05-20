@extends('layouts.app')

@section('css')
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/common-game-site.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/expansion-Legion.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/wow-legion.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/nav-client-desktop-legion.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/lightbox.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/build/cms.min.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/cms.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/sidebar.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/locale/'.app()->getLocale().'.css') }}" />
@endsection

@section('body')
homepage news
@endsection

@section('content')
<div id="content">
    <div class="content-top body-top">
        <div  class="content-trail">
            <ol class="ui-breadcrumb">
                <li class="last children" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
                    <a href="" rel="np" itemprop="url">
                        <span class="breadcrumb-text" itemprop="name">World of Warcraft</span>
                    </a>
                </li>
            </ol>
        </div>
        <div class="content-bot clear">

             <div id="slideshow" class="ui-slideshow">
                <div class="slideshow">
                    <div class="slide" id="slide-0" style="background-image: url('/uploads/slider/vk.jpg'); "></div>
                </div>
                <div class="paging">
                <a href="javascript:;" class="prev" onclick="Slideshow.prev();"></a>
                <a href="javascript:;" class="next" onclick="Slideshow.next();"></a>
            </div>

        <div class="caption">
            <h3><a href="javascript:;" class="link">test</a></h3>
        </div>
                <div class="preview"></div>
                <div class="mask"></div>
            </div>

            <script type="text/javascript">
                //<![CDATA[
                $(function() {
                    Slideshow.initialize('#slideshow', [
                         {
                        image: "/uploads/slider/vk.jpg",
                        desc: "test 2",
                        title: "test 2",
                        url: "test",
                        id: "2",
                        duration: 5                        },
                    ]);
                });
                //]]>
            </script>

            <div class="right-sidebar" >
                <div class="sidebar" id="sidebar">
                    <div class="sidebar-top">
                        <div class="sidebar-bot">
                            <div class="sidebar-loading" id="sidebar-loading">@lang('site.loading')</div>
                            <div id="dynamic-sidebar-target"></div>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    //<![CDATA[
                    $(function() {
                        Sidebar.sidebar([
                            { "type": "client", "query": "" },
                            { "type": "realm-status", "query": "" },
                            { "type": "events", "query": "" },
                            { "type": "blizzard-posts", "query": "" },
                        ]);
                    });
                    //]]>
                </script>
            </div>
            <div class="left-content" itemscope="itemscope" itemtype="http://schema.org/WebPageElement">
                <div class="left-container-inner">
                    <div class="featured-news-container">
                        <ul class="featured-news">
                            @foreach($featured as $item)
                            <li>
                                <div class="article-wrapper">
                                    <a href="{{ route('blog.show', ['id' => $item->id, 't' => $item->title ]) }}" class="featured-news-link" data-category="wow" data-action="Blog_Click-Throughs" data-label="home ">
                                        <div class="article-image" style="background-image:url({{ asset('uploads/images/'.$item->images) }})">
                                            <div class="article-image-frame"></div>
                                        </div>
                                        <div class="article-content">
                                            <span class="article-title" title="{{ $item->title }}">{{ $item->title }}</span>
                                            <span class="article-summary">{{ $item->title }}</span>
                                        </div>
                                    </a>
                                    <div class="article-meta">
                                        <a href="{{ route('blog.show', ['id' => $item->id, 't' => $item->title ]) }}#comments" class="comments-link">{{ App\Comment::where('post_id', $item->id)->count() }} </a>
                                        <span class="publish-date" title="{{ $item->created_at }}">{{ $item->created_at->format('d M Y') }}</span>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div id="blog-articles" class="blog-articles" itemscope="itemscope" itemtype="http://schema.org/Blog">
                        @foreach($blog as $item)
                        <div class="article-wrapper" >
                            <a href="{{ route('blog.show', ['id' => $item->id, 't' => $item->title ]) }}">
                                <div class="article-image" style="background-image:url({{ asset('uploads/images/'.$item->images) }})">
                                    <div class="article-image-frame"></div>
                                </div>

                                <div class="article-content">
                                    <h2 class="header-2"><span class="article-title">{{ $item->title }}</span></h2>
                                    <span class="clear"><!-- --></span>

                                    <div class="article-summary">
                                        {{ $item->desc_blog }}
                                    </div>
                                    <span class="clear"><!-- --></span>
                                    <meta content="{{ $item->created_at }}">
                                    <meta content="ru">
                                    <meta content="UserComments:{{ App\Comment::where('post_id', $item->id)->count() }} ">
                                    <meta content="{{ asset('uploads/images/'.$item->images) }}">
                                </div></a>

                            <div class="article-meta">
                                <span class="publish-date" title="{{ $item->created_at }}">{{ $item->created_at->format('d M Y') }}</span>
                                <a class="comments-link" href="{{ route('blog.show', ['id' => $item->id, 't' => $item->title ]) }}#comments">
                                    {{ App\Comment::where('post_id', $item->id)->count() }}
                                </a>
                            </div><span class="clear"><!-- --></span>
                        </div>
                        @endforeach
                    </div>
                    <span class="clear"></span>
                </div>
            </div>
        </div>
    </div>
 </div>
@endsection