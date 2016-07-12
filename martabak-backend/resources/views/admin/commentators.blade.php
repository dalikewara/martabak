@extends('admin.master')

@section('title')
<title>{{ Auth::user()->username }} | All commentators</title>
@endsection

@section('header-title')
Let's known people who has comments
@endsection

@section('content')
<div class="main-content">
    <div class="row">
        <div class="col-sm-3">
            <div class="auto">
                <p class="black">
                    People who leave or just has a comment on your content will displayed here
                    automatically. That's mean, the people are being remembered. If you won't system
                    remembered people automatically, you can make it on "General Setting" page.
                </p>
            </div>
            <div class="auto">
                <h4>Recent activities</h4>
                <hr>
                @foreach($contents->comments->orderBy('id', 'DESC')->take(7)->get() as $latest)
                    @if($latest->commentator != 0)
                        <h5><a class="{{ $themeColor }}" href="{{ $latest->guests->website }}">{{ $latest->guests->fullname }}</a> on post "<a class="{{ $themeColor }}" href="{{ $route->post_route }}/{{ $latest->posts->slug }}">{{ $latest->posts->title }}</a>" at <small>{{ $latest->created_at }}0000-00-00 00:00:00</small></h5>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="col-sm-9">
            <div class="layout">
                <div class="box-layout">
                    <div class="left">
                        <ul class="action-selected disable-pointer-events menu-inline">
                            <span><strong>Action selected: </strong></span>
                            <li>
                                <select id="process-action" name="{{ md5('process-action') }}">
                                    <option value="{{ md5('remove') }}" class="main-action main-action-remove">Forget forever</option>
                                </select>
                            </li>
                            <li><small class="click btn bg-{{ $themeColor }} btn-sm button-process" value="button-action">Process</small></li>
                        </ul>
                        <form id="form-process-action" role="form">
                            {!! csrf_field() !!}
                            <input type="hidden" name="{{ md5('process-option-remove') }}" value="{{ md5('yesIWantToRemove') }}">
                            <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('commentator') }}">
                            <input id="remove-action" type="hidden" class="{{ md5('remove') }}">
                        </form>
                    </div>
                    <div class="right">
                        <ul class="menu-inline">
                            <span><strong> Sorted by: </strong></span>
                            <li class="sorted-by">
                                <select name="sorted_by">
                                    <option id="sort-select-newer" class="sort" value="sortedBy-newer">Newer</option>
                                    <option id="sort-select-older" class="sort" value="sortedBy-older">Older</option>
                                </select>
                            </li>
                            <span><strong>Views per commentator: </strong></span>
                            <select>
                                <option id="pagiselect-12" class="sort" value="paginate-12">12</option>
                                <option id="pagiselect-24" class="sort" value="paginate-24">24</option>
                                <option id="pagiselect-50" class="sort" value="paginate-50">50</option>
                                <option id="pagiselect-100" class="sort" value="paginate-100">100</option>
                                <option id="pagiselect-150" class="sort" value="paginate-150">150</option>
                                <option id="pagiselect-250" class="sort" value="paginate-250">250</option>
                                <option id="pagiselect-500" class="sort" value="paginate-500">500</option>
                                <option id="pagiselect-1000" class="sort" value="paginate-1000">1000</option>
                            </select>
                        </ul>
                    </div>
                    <hr>
                </div>
                <div class="box-layout box-search-schedule">
                    <div class="left">
                        <div id="schedule-date-action" class="none">
                            <small>Date & Time: </small>
                            <input id="input-schedule-date-action" class="form-control" type="text" name="{{ md5('schedule-date-action') }}" value="0000-00-00 00:00">
                            <small class="smoke">Format: Y-m-d H:i</small>
                        </div>
                    </div>
                </div>
                <div id="content">
                    <div id="loading-content" class="loading text-center">
                        <img src="/admin/assets/icons/loading.gif" />
                        <p>Loading commentators...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <p id="alert" class="alert alert-danger none">There are some errors</p>
</div>
@endsection

@section('script')

@endsection

@section('style')
<style media="screen">
    #sort-latest:hover, #sort-watched:hover, #sort-notwatched:hover, #sort-comment:hover, #sort-favourite:hover
    {
        opacity: 0.8;
        box-shadow: 0 0 4px rgba(0, 0, 0, 0.3);
    }

    .commentator-content
    {
        margin-left: 10px;
    }

    .box-layout
    {
        overflow: auto;
    }

    ul.menu-inline li.sorted-by
    {
        margin-right: 10px;
    }

    .box-search-schedule
    {
        margin: 0 0 18px;
    }

    .commentator-layout
    {
        margin: 5px;
        border-radius: 2px;
        padding: 10px;
        box-shadow: 0 0 1px rgba(0, 0, 0, 0.5);
    }

    .commentator-layout:hover
    {
        box-shadow: 0 0 1px rgba(0, 0, 0, 0.3);
        opacity: 0.8;
    }

    .tumb-commentator
    {
        font-size: 6em;
    }

    .commentator-option
    {
        margin: 0 0 10px;
    }

    .tr-edit-commentator
    {
        padding: 10px;
    }

    .edit-button-commentator
    {
        margin: 10px 0 0;
    }

    .sort-notif
    {
        padding: 10px;
        margin: 0 0 -10px;
    }

    .commentators-layout
    {
        margin: 0 0 20px;
        padding: 0 0 5px;
        border-bottom: 1px dashed rgb(121, 121, 121);
    }

    .commentators-pic
    {
        width: 60px;
        height: 60px;
    }
</style>
@endsection
