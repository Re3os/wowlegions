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
<a href="{{ route('bugtracker-create') }}" rel="np" itemprop="url">
<span class="breadcrumb-text" itemprop="name">New issue</span>
</a>
</li>
</ol>
</div>
<div class="main_b_holder">
<div class="content_holder">
<div class="body_content self_clear">
<!-- Main side -->
    <div id="content_ajax"><div id="page_bugtracker" class="page page_bugtracker margin_ctrl">
    <div class="page_body border_box"><div class="bugtracker create_issue">

    <!-- Welcome section -->
    <div class="bt_section bt_welcome">
        <div class="bt_welcome_body">
            Welcome to our bugtracker. In here you can search for bugreports or make one yourself. Our format is very detailed, so make sure to use it properly.<br />
            Apply as much info as possible to make it easier for us to fix the issue. Thank you.

            <br />
            <br />

            Get going and grab your reward today!
        </div>
    </div>

    <!-- Issue form section -->
    <div class="bt_section bt_issueform">
        <div class="bt_issueform_body">
            <form action="{{ route('bugtracker-submit') }}" method="post" accept-charset="utf-8">
                {{ csrf_field() }}
                <div class="bt_row">
                    <label class="bt_invisible" for="bt_title">Title</label>
                    <input type="text" name="title" autocomplete="off" placeholder="Enter issue title here..." maxlength="100" value="" data-required />
                </div>

                <div class="bt_row">
                <div class="bt_column" style="width:70%;margin-right:0">
                <div class="bt_column" id="bt_cat">
                <label class="bt_hidden" for="cat">Category</label>
                <select name="cat" id="cat" data-required>
                <option value="" selected disabled>Choose a category</option>
                <option value="0">Achievements</option>
                <option value="1">Classes</option>
                <option value="2">Creatures</option>
                <option value="3">Instances</option>
                <option value="4">Items</option>
                <option value="5">Spells</option>
                <option value="6">Quests</option>
                <option value="7">Website</option>
                <option value="8">Others</option>
                <option value="9">PvP</option>
                </select>
                </div>

                <div class="bt_column" id="bt_subcat" style="display:none">
                <label class="bt_hidden" for="subcat">Subcategory</label>
                <select name="subcat" id="subcat" class="clearfix" data-category="1" data-required disabled>
                <option value="" selected disabled>Choose a subcategory</option>
                <option value="0">General</option>
                <option value="2">Druid</option>
                <option value="3">Hunter</option>
                <option value="4">Mage</option>
                <option value="5">Paladin</option>
                <option value="6">Priest</option>
                <option value="7">Rogue</option>
                <option value="8">Shaman</option>
                <option value="9">Warlock</option>
                <option value="10">Warrior</option>
                </select>
                <select name="subcat" id="subcat" class="clearfix" data-category="2" data-required disabled>
                <option value="" selected disabled>Choose a subcategory</option>
                <option value="0">General</option>
                <option value="11">Kalimdor</option>
                <option value="12">Eastern Kingdoms</option>
                <option value="13">Outlands</option>
                <option value="14">Northrend</option>
                <option value="16">Raid/Dungeon</option>
                </select>
                <select name="subcat" id="subcat" class="clearfix" data-category="3" data-required disabled>
                <option value="" selected disabled>Choose a subcategory</option>
                <option value="17">Dungeons</option>
                <option value="18">Raids</option>
                </select>
                                                                                                                                                                    <select name="subcat" id="subcat" class="clearfix" data-category="7" data-required disabled>
                <option value="" selected disabled>Choose a subcategory</option>
                <option value="19">Main site</option>
                <option value="20">Forums</option>
                </select>

                <select name="subcat" id="subcat" class="clearfix" data-category="9" data-required disabled>
                <option value="" selected disabled>Choose a subcategory</option>
                <option value="21">Battleground</option>
                <option value="22">Arena</option>
                <option value="23">World</option>
                <option value="24">Other</option>
                </select>

                </div>
                <div class="clear"></div>

                </div>

                <div class="bt_column">
                <label class="bt_hidden">Priority</label>
                <label for="priority-0"><input type="radio" name="priority" value="0" id="priority-0" checked /> Priority None</label>
                <label for="priority-5"><input type="radio" name="priority" value="1" id="priority-5"  /> Priority Low</label>
                <label for="priority-10"><input type="radio" name="priority" value="2" id="priority-10"  /> Priority Medium</label>
                <label for="priority-15"><input type="radio" name="priority" value="3" id="priority-15"  /> Priority High</label>
                </div>
                </div>

                <div class="bt_row">
                    <label class="bt_invisible">Description</label>
                    <textarea name="issue" placeholder="Describe your issue with details as much as you can..."></textarea>
                </div>

                <div class="bt_row">
                    <div class="bt_column">
                        <input class="inputs" type="submit" value="Post issue" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">

    $('#bt_cat').on('change', '[name=cat]', function() {
        selector = $(this);

        $('#bt_subcat').stop().fadeOut(400, function() {
            selectors = $(this).find('select');

            // Pre-disable all selectors
            selectors.prop('disabled', true);

            typeof $.selectbox === 'undefined' ? selectors.hide() :
                selectors.next('.sbHolder').hide();

            container = $('[data-category="' + selector.val() + '"]');
            if(!container || !container.length)
                return;

            // Enable the subcategory selector
            container.prop('disabled', false);

            typeof $.selectbox === 'undefined' ? container.show() :
                container.next('.sbHolder').show()
                    .parent().show();

            // Display the selectors' holder
            $(this).fadeIn();
        });
    });

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
</script>
</div>
</div>

</div>
</div>
</div>
</div>
</div>
</div>
@endsection