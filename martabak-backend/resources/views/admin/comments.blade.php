@extends('admin.master')

@section('title')
<title>{{ Auth::user()->username }} | All comments</title>
@endsection

@section('header-title')
View what you have written
@endsection

@section('content')
<div class="main-content">
    <div class="layout">
        <div class="auto">
            <div class="menu-layout right">
                <ul class="menu-inline">
                    <span><strong>Show: </strong></span>
                    <li id="sort-latest" class="pointer transition sort active bg-{{ $themeColor }}" value="status-comment-1-{{ $themeColor }}">Latest</li>
                    <li id="sort-approved" class="pointer transition sort unactive" value="status-comment-2-{{ $themeColor }}">Approved</li>
                    <li id="sort-notapproved" class="pointer transition sort unactive" value="status-comment-3-{{ $themeColor }}">Not approved</li>
                    <li id="sort-spam" class="pointer transition sort unactive" value="status-comment-4-{{ $themeColor }}">Spam</li>
                    <li id="sort-blacklist" class="pointer transition sort unactive" value="status-comment-5-{{ $themeColor }}">Blacklist</li>
                </ul>
            </div>
            <div class="left">
                <p class="black">
                    Manage your comments, use "Action selected" to execute some works.
                    <br>
                    You can sort comments by using options on the right.
                </p>
            </div>
        </div>
        <div class="auto">
            <div class="right">
              <ul class="menu-inline">
                  <span><strong> Sorted by: </strong></span>
                  <li class="sorted-by">
                      <select name="sorted_by">
                          <option id="sort-select-newer" class="sort" value="sortedBy-newer">Newer</option>
                          <option id="sort-select-older" class="sort" value="sortedBy-older">Older</option>
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
                            <option value="{{ md5('remove') }}" class="main-action main-action-remove">Remove permanently</option>
                            <option value="{{ md5('approve') }}" class="main-action main-action-approve none">Approve</option>
                            <option value="{{ md5('dontapprove') }}" class="main-action main-action-dontapprove none">Don't approve</option>
                            <option value="{{ md5('spam') }}" class="main-action main-action-spam">Add to spam</option>
                            <option value="{{ md5('blacklist') }}" class="main-action main-action-blacklist">Add to blacklist</option>
                        </select>
                    </li>
                    <li><small class="click btn bg-{{ $themeColor }} btn-sm button-process bg-{{ $themeColor }}" value="button-action">Process</small></li>
                </ul>
                <form id="form-process-action" role="form">
                    {!! csrf_field() !!}
                    <input type="hidden" name="{{ md5('process-option-remove') }}" value="{{ md5('yesIWantToRemove') }}">
                    <input type="hidden" name="{{ md5('process-option-status') }}" value="{{ md5('yesIWantToChangeStatus') }}">
                    <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('page') }}">
                    <input id="remove-action" type="hidden" class="{{ md5('remove') }}">
                    <input id="id-action" type="hidden" class="{{ md5('id') }}">
                    <input id="status-action" type="hidden" class="{{ md5('status') }}">
                </form>
            </div>
        </div>
        <div class="auto box-search-schedule">
            <div class="right">
                <input id="search" class="form-control left" type="text" name="search" placeholder="Search page...">
                <small id="process-search" class="sort btn bg-{{ $themeColor }} btn-sm right bg-{{ $themeColor }}" value="search">Search</small>
            </div>
        </div>
        <div id="content">
            <div id="loading-content" class="loading text-center">
                <img src="/admin/assets/icons/loading.gif" />
                <p>Loading comments...</p>
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
    #sort-latest:hover, #sort-approved:hover, #sort-notapproved:hover, #sort-spam:hover, #sort-blacklist:hover
    {
        opacity: 0.8;
        box-shadow: 0 0 4px rgba(0, 0, 0, 0.3);
    }

    ul.menu-inline li.sorted-by
    {
        margin-right: 10px;
    }

    .tr-top
    {
        box-shadow: 0 0 0 rgb(0, 0, 0);
    }

    .th-commentator
    {
        width: 10%;
    }

    .th-in-reply
    {
        width: 15%;
    }

    .th-content
    {
        width: 53%;
    }

    .th-date
    {
        width: 13%;
    }

    .th-tasks
    {
        width: 15%;
    }
</style>
@endsection
