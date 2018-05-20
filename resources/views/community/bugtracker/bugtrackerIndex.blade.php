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
<div id="content_ajax">
    <div id="page_bugtracker" class="page page_bugtracker margin_ctrl">
    <div class="page_body border_box">
        <div class="bugtracker">
            <!-- Report a bug section -->
        <div class="bt_section bt_createreport">
            <div class="bt_createreport_body">
                    <a href="{{ route('bugtracker-create') }}" class="nice_button" data-hasevent="1">Create issue</a>
                    <span>
                    Create a report and get rewarded
                    <i>Create a report and get rewarded</i>
                    </span>

                <i>Get rewarded for every confirmed report</i>
            </div>
        </div>
    <!-- Reports table section -->
    <div class="bt_section bt_reports_table">
                    <table>
                <thead>
                    <tr>
                        <td class="head_bt_id">ID</td>
                        <td class="head_bt_title" style="width:36%">Title</td>
                        <td class="head_bt_cat">Category</td>
                        <td class="head_bt_subcat">Subcategory</td>
                        <td class="head_bt_status">Status</td>
                        <td class="head_bt_proprity">Priority</td>
                        <td class="head_bt_update">Update</td>
                    </tr>
                </thead>

                <tbody>
                    @foreach($bug as $item)
                    <tr id="issue-{{ $item->id }}" class="bt_status-0 bt_priority-15 ">
                    <td class="bt_id">{{ $item->id }}</td>
                    <td class="bt_title"><a href="{{ route('bugtracker-view', [$item->id])}}" title="{{ $item->title }}" data-hasevent="1">{{ $item->title }}</a></td>
                    <td class="bt_category">Creatures</td>
                    <td class="bt_subcategory">Kalimdor</td>
                    <td class="bt_status">Pending</td>
                    <td class="bt_priority">Low</td>
                    <td class="bt_update"><time datetime="{{ $item->created_at->diffForHumans() }}" title="Edited on {{ $item->updated_at->diffForHumans() }}">{{ $item->created_at->diffForHumans() }}</time></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        <div class="bt_reports_foot">
            <div class="bt_pagination type-numeric">
                {{ $bug->links('community.bugtracker.paginate') }}
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection