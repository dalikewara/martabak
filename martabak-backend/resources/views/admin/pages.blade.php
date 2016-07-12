@extends('admin.master')

@section('title')
<title>{{ Auth::user()->username }} | All pages</title>
@endsection

@section('header-title')
View what you have written
@endsection

@section('content')
<div class="main-content">
    <div class="layout">
        <div class="box-layout">
            <div class="menu-layout right">
                <ul class="menu-inline">
                    <span><strong>Show: </strong></span>
                    <li id="sort-published" class="pointer transition sort active bg-{{ $themeColor }}" value="status-1-{{ $themeColor }}">Published</li>
                    <li id="sort-drafted" class="pointer transition sort unactive" value="status-2-{{ $themeColor }}">Drafted</li>
                    <li id="sort-scheduled" class="pointer transition sort unactive" value="status-3-{{ $themeColor }}">Scheduled</li>
                </ul>
            </div>
            <div class="left">
                <p class="black">
                    Manage your pages, use "Action selected" to execute some works.
                    <br>
                    You can sort pages by using options on the right.
                </p>
            </div>
        </div>
        <div class="box-layout">
            <div class="right">
              <ul class="menu-inline">
                  <span><strong> Sorted by: </strong></span>
                  <li class="sorted-by">
                      <select name="sorted_by">
                          <option id="sort-select-newer" class="sort" value="sortedBy-newer">Newer</option>
                          <option id="sort-select-older" class="sort" value="sortedBy-older">Older</option>
                          <option id="sort-select-title" class="sort" value="sortedBy-title">Title</option>
                      </select>
                  </li>
                  <span><strong>Views per page: </strong></span>
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
            <div class="left">
                <ul class="action-selected disable-pointer-events menu-inline">
                    <span><strong>Action selected: </strong></span>
                    <li>
                        <select id="process-action" name="{{ md5('process-action') }}">
                            <option value="{{ md5('trash') }}" class="main-action main-action-trash">Move to trash</option>
                            <option value="{{ md5('remove') }}" class="main-action main-action-remove">Remove permanently</option>
                            <option value="{{ md5('publish') }}" class="main-action main-action-publish none">Publish</option>
                            <option value="{{ md5('draft') }}" class="main-action main-action-draft">Set to draft</option>
                            <option id="schedule-action" value="{{ md5('schedule') }}" class="main-action-schedule">Set to schedule</option>
                        </select>
                    </li>
                    <li><small class="click btn bg-{{ $themeColor }} btn-sm button-process" value="button-action">Process</small></li>
                </ul>
                <form id="form-process-action" role="form">
                    {!! csrf_field() !!}
                    <input type="hidden" name="{{ md5('process-option-trash') }}" value="{{ md5('yesIWantToTrash') }}">
                    <input type="hidden" name="{{ md5('process-option-remove') }}" value="{{ md5('yesIWantToRemove') }}">
                    <input type="hidden" name="{{ md5('process-option-status') }}" value="{{ md5('yesIWantToChangeStatus') }}">
                    <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('page') }}">
                    <input id="trash-action" type="hidden" class="{{ md5('trash') }}">
                    <input id="remove-action" type="hidden" class="{{ md5('remove') }}">
                    <input id="id-action" type="hidden" class="{{ md5('id') }}">
                    <input id="status-action" type="hidden" class="{{ md5('status') }}">
                </form>
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
            <div class="right">
                <input id="search" class="form-control left" type="text" name="search" placeholder="Search page...">
                <small id="process-search" class="sort btn bg-{{ $themeColor }} btn-sm right" value="search">Search</small>
            </div>
        </div>
        <div id="content">
            <div id="loading-content" class="loading text-center">
                <img src="/admin/assets/icons/loading.gif" />
                <p>Loading pages...</p>
            </div>
        </div>
    </div>
    <div id="trash" class="trash">
        <div id="loading-trash" class="loading text-center">
            <img src="/admin/assets/icons/loading.gif" />
            <p>Loading trash...</p>
        </div>
    </div>
    <p id="alert" class="alert alert-danger none">There are some errors</p>
</div>
@endsection

@section('script')

@endsection

@section('style')
<style media="screen">
    #sort-published:hover, #sort-drafted:hover, #sort-scheduled:hover
    {
        opacity: 0.8;
        box-shadow: 0 0 4px rgba(0, 0, 0, 0.3);
    }

    .quick
    {
        text-decoration: underline;
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

    .page-layout
    {
        margin: 5px;
        border-radius: 2px;
    }

    .page-layout:hover
    {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        opacity: 0.9;
    }

    .tumb-page
    {
        font-size: 6em;
    }

    .page-option
    {
        margin: 0 0 10px;

    }

    .tr-edit-page
    {
        padding: 10px;
    }

    .edit-button-page
    {
        margin: 10px 0 0;
    }

    .task-page
    {
        padding: 5px 0 0;
    }

    .page-title
    {
        font-size: 16px;
    }

    .page-desc
    {
        opacity: 0.8;
        font-size: 10px;
    }
</style>
@endsection
