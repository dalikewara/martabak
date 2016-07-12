@extends('admin.master')

@section('title')
<title>{{ Auth::user()->username }} | All themes</title>
@endsection

@section('header-title')
View what you have written
@endsection

@section('content')
<div class="main-content">
    <div class="layout">
        @if(count($themes->where('theme_status', '1')) != 0)
            @foreach($themes->where('theme_status', '1')->take(1) as $theme)
                <div class="box-theme-active bg-smoke">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="">
                                <img class="theme-active-img" src="/admin/assets/icons/setting.png" alt="" />
                            </div>
                            <br>
                        </div>
                        <div class="col-sm-9">
                            <h3>{{ $theme->title }} <small class="green">Actived</small></h3>
                            <button class="btn btn-no click" value="active-deactive">Deactive</button>
                            <button class="btn btn-danger click" value="active-remove">Remove</button>
                            <div id="child-content-tasks-active">
                            </div>
                            <h5><strong>Author:</strong> {{ $theme->author }}</h5>
                            <h5><strong>Price:</strong> {{ $theme->theme_price }}</h5>
                            <h5><strong>Category:</strong> {{ $theme->theme_category }}</h5>
                            <h5><strong>Version:</strong> {{ $theme->theme_version }}</h5>
                            <h5><strong>Date release:</strong> {{ $theme->theme_date_release }}</h5>
                            <h5><strong>Url:</strong> <a href="http://{{ $theme->theme_url }}">{{ $theme->theme_url }}</a></h5>
                            <h5><strong>Description:</strong> {{ $theme->theme_description }}</h5>
                        </div>
                    </div>
                </div>
                <form id="form-remove-active" role="form">
                    {{ csrf_field() }}
                    <input type="hidden" name="{{ md5('theme') }}-{{ md5($theme->id) }}" value="{{ md5($theme->id) }}">
                    <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToRemove') }}">
                    <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('theme') }}">
                </form>
                <form id="form-deactive-active" role="form">
                    {{ csrf_field() }}
                    <input type="hidden" name="{{ md5('theme') }}-{{ md5($theme->id) }}" value="{{ md5($theme->id) }}">
                    <input type="hidden" name="{{ md5('process-option-status') }}" value="{{ md5('yesIWantToChangeStatus') }}">
                    <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('theme') }}">
                    <input type="hidden" name="{{ md5('active-status') }}" value="{{ md5('deactive') }}">
                </form>
            @endforeach
        @else
            <h1 class="smoke text-center roboto empty-content">You have no active theme. You should have one.</h1>
        @endif
        <br>
        <div class="box-layout">
            <div class="left">
                <p class="black">
                    Manage your themes, use "Action selected" to execute some works.
                    <br>
                    You can sort themes by using options on the right.
                </p>
            </div>
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
                    <span><strong>Views per theme: </strong></span>
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
                    <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('theme') }}">
                    <input id="remove-action" type="hidden" class="{{ md5('remove') }}">
                    <input id="id-action" type="hidden" class="{{ md5('id') }}">
                </form>
            </div>
            <div class="right">
                <input id="search" class="form-control left" type="text" name="search" placeholder="Search theme...">
                <small id="process-search" class="sort btn bg-{{ $themeColor }} btn-sm right" value="search">Search</small>
            </div>
        </div>
        <div id="content">
            <div id="loading-content" class="loading text-center">
                <img src="/admin/assets/icons/loading.gif" />
                <p>Loading themes...</p>
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
    #sort-published:hover, #sort-drafted:hover, #sort-scheduled:hover
    {
        background: rgb(38, 97, 31);
        color: rgb(255, 255, 255);
        box-shadow: 0 0 4px rgba(0, 0, 0, 0.3);
    }

    .box-layout
    {
        overflow: auto;
    }

    .continue-remove
    {
      margin: 10px 0 0;
      padding: 10px;
      color: rgb(80, 80, 80);
    }

    ul.menu-inline li.sorted-by
    {
        margin-right: 10px;
    }

    .box-search-schedule
    {
        margin: 0 0 18px;
    }

    .theme-layout
    {
        margin: 5px;
        border-radius: 2px;
    }

    .theme-layout:hover
    {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        opacity: 0.9;
    }

    .tumb-theme
    {
        font-size: 6em;
    }

    .theme-option
    {
        margin: 0 0 10px;

    }

    .tr-edit-theme
    {
        padding: 10px;
    }

    .edit-button-theme
    {
        margin: 10px 0 0;
    }

    .theme-content
    {
        padding: 8px;
        margin: 5px 10px 5px 2px;
        box-shadow: 0 0 2px rgba(0, 0, 0, 0.5);
    }

    .theme-content:hover
    {
        border-radius: 20px;
        box-shadow: 0 0 1px rgba(0, 0, 0, 0.5);
        background: rgb(244, 244, 244);
    }

    .theme-main-content
    {
        margin: 10px 0 0;
        width: auto;
    }

    .row-theme
    {
        margin-left: 0;
        margin-right: 0;
    }

    .theme-name-text
    {
        font-size: 16px;
    }

    .theme-img
    {
        width: 100%;
        height: 170px;
    }

    .box-theme-active
    {
        width: 100%;
        padding: 20px;
        border-bottom: 2px dashed rgb(191, 191, 191);
    }

    .theme-active-img
    {
        width: 100%;

    }
</style>
@endsection
