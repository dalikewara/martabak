@extends('admin.master')

@section('title')
<title>{{ Auth::user()->username }} | All notifications</title>
@endsection

@section('header-title')
View what you have written
@endsection

@section('content')
<div class="main-content">
    <div class="row">
        <div class="col-sm-3">
            <div class="auto">
                <p class="black">
                    Manage your notifications, use "Action selected" to execute some works.
                    <br>
                    You can sort notifications by using options on the right.
                </p>
            </div>
            <div class="menu-layout text-center">
                    <div id="sort-latest" class="sort-notif pointer transition sort active bg-{{ $themeColor }}" value="status-notification-1-{{ $themeColor }}">
                        Latest <span class="badge">{{ count($contents->notifications->where('created_at', '>', $dateBottom)->get()) }}</span>
                    </div>
                    <br>
                    <div id="sort-watched" class="sort-notif pointer transition sort unactive" value="status-notification-2-{{ $themeColor }}">
                        Watched <span class="badge">{{ count($contents->notifications->where('status', 1)->get()) }}</span>
                    </div>
                    <br>
                    <div id="sort-notwatched" class="sort-notif pointer transition sort unactive" value="status-notification-3-{{ $themeColor }}">
                        Not Watched <span class="badge">{{ count($contents->notifications->where('status', 0)->get()) }}</span>
                    </div>
                    <br>
                    <div id="sort-comment" class="sort-notif pointer transition sort unactive" value="status-notification-4-{{ $themeColor }}">
                        Comment <span class="badge">{{ count($contents->notifications->where('type', 1)->get()) }}</span>
                    </div>
                    <br>
                    <div id="sort-favourite" class="sort-notif pointer transition sort unactive" value="status-notification-5-{{ $themeColor }}">
                        Favourite <span class="badge">{{ count($contents->notifications->where('type', 2)->get()) }}</span>
                    </div>
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
                                    <option value="{{ md5('remove') }}" class="main-action main-action-remove">Remove permanently</option>
                                </select>
                            </li>
                            <li><small class="click btn bg-{{ $themeColor }} btn-sm button-process" value="button-action">Process</small></li>
                        </ul>
                        <form id="form-process-action" role="form">
                            {!! csrf_field() !!}
                            <input type="hidden" name="{{ md5('process-option-remove') }}" value="{{ md5('yesIWantToRemove') }}">
                            <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('notification') }}">
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
                            <span><strong>Views per notification: </strong></span>
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
                        <p>Loading notifications...</p>
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

    .notification-content
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

    .notification-layout
    {
        margin: 5px;
        border-radius: 2px;
        padding: 10px;
        box-shadow: 0 0 1px rgba(0, 0, 0, 0.5);
    }

    .notification-layout:hover
    {
        box-shadow: 0 0 1px rgba(0, 0, 0, 0.3);
        opacity: 0.8;
    }

    .tumb-notification
    {
        font-size: 6em;
    }

    .notification-option
    {
        margin: 0 0 10px;
    }

    .tr-edit-notification
    {
        padding: 10px;
    }

    .edit-button-notification
    {
        margin: 10px 0 0;
    }

    .sort-notif
    {
        padding: 10px;
        margin: 0 0 -10px;
    }
</style>
@endsection
