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
                        <span class="breadcrumb-text" itemprop="name">Сообщество</span>
                    </a>
                </li>
                <li class="last children" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
                    <a href="{{ route('bugtracker') }}" rel="np" itemprop="url">
                        <span class="breadcrumb-text" itemprop="name">Bugtracker</span>
                    </a>
                </li>
            </ol>
        </div>
<div class="main_b_holder">
<div class="content_holder">
<div class="body_content self_clear">
    <script type="text/javascript">
        $('.welcome_to').on('click', '.close_btn', function(event) {
            event.preventDefault();
            $('.welcome_to').fadeOut('slow');
        });
    </script>
    <div id="content_ajax"><div id="page_bugtracker" class="page page_bugtracker margin_ctrl">
    <div class="page_body border_box"><div class="bugtracker advanced_view">

    <!-- Comment form section -->
    <div id="bt_commentform" class="bt_section bt_commentform">
        <div class="bt_commentform_body">
            <form action="{{ route('bugtracker-comment-submit') }}" method="post" accept-charset="utf-8" onsubmit="formValidate(event, this)">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $bug->id }}" />
                <input type="hidden" name="issue_id" value="{{ $bug->bugtracker_id }}" />
                <textarea name="comment" id="bt_comment" dir="auto" placeholder="Post something or start discussing..."  data-required>{{ $bug->text }}</textarea>
     <input class="inputs" type="submit" id="bt_submit" value="Edit Comment" />
            </form>
        </div>
    </div>
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
</script>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection