@extends('layouts.app')

@section('css')
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/common-game-site.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/expansion-Legion.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/wow-legion.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/nav-client-desktop-legion.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/community.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/lightbox.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/build/cms.min.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/cms.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/sidebar.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/realmstatus.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/game/events.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/bugtracker.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/bugtracker/wow.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/bugtracker/style.css') }}" />
@endsection

@section('body')
community-home
@endsection

@section('content')
<div id="content">
    <div class="content-top body-top">
        <div class="content-trail">
            <ol class="ui-breadcrumb">
                <li itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
                    <a href="/" rel="np" class="breadcrumb-arrow" itemprop="url">
                        <span class="breadcrumb-text" itemprop="name">World of Warcraft</span>
                    </a>
                </li>
                <li itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
                    <a href="{{ route('community') }}" rel="np" class="breadcrumb-arrow" itemprop="url">
                        <span class="breadcrumb-text" itemprop="name">Community</span>
                    </a>
                </li>
                <li itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
                    <a href="{{ route('bugtracker') }}" rel="np" class="breadcrumb-arrow" itemprop="url">
                        <span class="breadcrumb-text" itemprop="name">Bugtracker</span>
                    </a>
                </li>
                <li class="last children" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
                    <a href="{{ route('bugtracker-view', [$bug->id])}}" rel="np" itemprop="url">
                        <span class="breadcrumb-text" itemprop="name">{{ $bug->title }}</span>
                    </a>
                </li>
            </ol>
        </div>
<div class="main_b_holder">
<div class="content_holder">
<div class="body_content self_clear">
<!-- Main side -->
    <div id="content_ajax"><div id="page_bugtracker" class="page page_bugtracker margin_ctrl">
    <div class="page_body border_box"><div class="bugtracker advanced_view">
    <!-- Reports table section -->
    <div id="issue-633" class="bt_section bt_reports_table bt_status-0 bt_priority-15 ">
        <table>
            <thead>
                <tr>
                    <td class="head_bt_id">ID</td>
                    <td class="head_bt_status">Status</td>
                    <td class="head_bt_priority">Priority</td>
                    <td class="head_bt_author">Author</td>
                    <td class="head_bt_create">Create</td>
                    <td class="head_bt_update">Update</td>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td class="bt_id">{{ $bug->id }}</td>
                    <td class="bt_status">Pending</td>
                    <td class="bt_priority">Low</td>
                    <td class="bt_author">{{ $bug->user->name }}</td>
                    <td class="bt_create"><time datetime="{{ $bug->created_at->diffForHumans() }}" title="Posted on {{ $bug->created_at->diffForHumans() }}">{{ $bug->created_at->diffForHumans() }}</time></td>
                    <td class="bt_update"><time datetime="{{ $bug->updated_at->diffForHumans() }}" title="Edited on {{ $bug->updated_at->diffForHumans() }}">{{ $bug->updated_at->diffForHumans() }}</time></td>
                </tr>
            </tbody>
        </table>

        <!-- Advanced info section -->
        <div class="bt_section bt_post @if(Auth::user()->admin) bt_bluepost @endif">
            <div class="bt_authorinfo">
                <span class="item_avatar item_author">
                   <img src="@if(Auth::user()->admin) {{ asset('images/avatars/avatar-default.png') }} @else {{ asset('images/avatars/wow/avatar-wow-default.png') }} @endif" width="120" height="120" alt="{{ $bug->user->name }} avatar" />
                </span>
                <a class="item_author" title="{{ $bug->user->name }}">@if(Auth::user()->admin) <img src="{{ asset('images/icons/icon_blizzard.gif') }}" alt="Staff member" width="20" height="13" /> @endif  {{ $bug->user->name }}</a>
            </div>
            <div class="bt_contentinfo">
                <div class="item_actions"></div>

                <h2><span class="item_title">{{ $bug->title }}</span></h2>
                <p class="item_content">{{ $bug->full_text }}</p>

                <div class="item_extra"></div>
            </div>

            <div class="bt_divider"></div>

            <div class="bt_footerinfo ">
                <div class="bt_footerinfoleft">
                                    </div>
                <div class="bt_footerinforight">
                    <!--a href="#" class="item_report">Report this as spam</a-->
                    (<span style="padding:0" class="item_voteup">+1</span> votes)
                    <a href="#bt_commentform" class="item_replay" data-hasEvent="1">Reply</a>
                    @if(Auth::user()->admin)
                    <a href="/community/bugtracker/delete/17" class="item_voteup" data-hasEvent="1">Delete</a>
                    <a href="/community/bugtracker/closed/17" class="item_voteup" data-hasEvent="1">Closed</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Advanced info comment section -->
    <div id="bt_comments" class="bt_posts bt_comments">
            @foreach($bug->comments as $comment)
            <div id="comment-{{ $comment->id }}" class="bt_section bt_post bt_comment <!--bt_bluepost-->">
            <div class="bt_authorinfo">
            <span class="item_avatar item_author">
                <img src="@if(Auth::user()->admin) {{ asset('images/avatars/avatar-default.png') }} @else {{ asset('images/avatars/wow/avatar-wow-default.png') }} @endif" width="120" height="120" alt="{{ $comment->user->name }} avatar" />
             </span>
                            <a class="item_author" title="{{ $comment->user->name }}">@if(Auth::user()->admin) <img src="{{ asset('images/icons/icon_blizzard.gif') }}" alt="Staff member" width="20" height="13" /> @endif {{ $comment->user->name }}</a>
                        </div>

            <div class="bt_contentinfo">
            <div class="item_actions">
            <a href="{{ route('bugtracker-comment-edit', [$comment->id]) }}"><img src="{{ asset('images/icons/pencil.png') }}" alt="Edit comment" width="16" height="16" /></a>															</div>
            <span class="item_date"><time datetime="{{ $comment->created_at->diffForHumans() }}" title="Posted on {{ $comment->created_at->diffForHumans() }}">{{ $comment->created_at->diffForHumans() }}</time></span>
            <p class="item_content">{{ $comment->text }}</p>
            <div class="item_extra">
            </div>
            </div>
            </div>
            @endforeach
            <!-- Pagination holder section -->
            <div class="bt_section bt_pagination_holder">
                <div class="bt_pagination type-advanced">

                </div>
            </div>
            </div>

            @if(!$bug->closed)    <div id="bt_commentform" class="bt_section bt_commentform">
            <div class="bt_commentform_body">
                <form action="{{ route('bugtracker-comment') }}" method="post" accept-charset="utf-8" onsubmit="formValidate(event, this)">
                    {{ csrf_field() }}
                    <input type="hidden" name="issue_id" value="{{ $bug->id }}" />
                        <textarea name="comment" id="bt_comment" dir="auto" placeholder="Post something or start discussing..."  data-required></textarea>
                    <input class="inputs" type="submit" id="bt_submit" value="Post Comment" />
                </form>
            </div>
        </div>@endif
            </div>

<script type="text/javascript">
    $('.bt_header').appendTo('#right .page_title > h3').fadeIn('slow');

    function formValidate(event, element) {
        if($(element).data('in-progress'))
        {
            event.preventDefault ? event.preventDefault() : event.returnValue = false;
            return false;
        }

        $(element).find(':input[data-required]:visible, select:has(+ .sbHolder:visible)').each(function() {
            if($(this).data('required') === undefined || $.trim($(this).val()))
                return;

            event.preventDefault ? event.preventDefault() : event.returnValue = false;
            UI.alert('Please fill out ' + $(this).prop('name') + ' field');
            event.busy = true;
            return false;
        });

        event.busy || $(element).data('in-progress', true);
    };
</script></div>
</div>

<script type="text/javascript">
    var body = document.getElementsByTagName("body")[0];
    if(body.className.indexOf('page-container') == -1)
        body.className += 'page-container';

            if(body.className.indexOf(' page-custom') == -1)
            body.className += ' page-custom';

            if(body.className.indexOf(' page-full-width') == -1)
            body.className += ' page-full-width';

    if(typeof CustomJS !== 'undefined')
        CustomJS.initialize();
</script></div>
                    <!-- Main side.End -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection