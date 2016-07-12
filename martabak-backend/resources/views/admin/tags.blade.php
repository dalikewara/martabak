@extends('admin.master')

@section('title')
<title>{{ Auth::user()->username }} | Tags</title>
@endsection

@section('header-title')
So, take care about tags relationship
@endsection

@section('content')
<div class="main-content">
    <div class="row">
        <div class="col-sm-3">
            <div class="left">
                <p class="black">
                    Manage your tags, use "Action selected" to execute some works.
                    You can sort tags by using options on the right.
                </p>
                <hr>
            </div>
            <div class="">
                <h5><strong>Add new tag</strong></h5>
                <hr>
                <p class="smoke">
                  By default, "tag slug" will be filled automatically when you typing on the tag name.
                  Otherwise, you can set it manually.
                </p>
                <form id="form-create" role="form">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <input class="create-input input-name form-control" type="text" name="{{ md5('name') }}" placeholder="Enter tag name...">
                    </div>
                    <div class="form-group">
                        <input class="create-input input-slug form-control" type="text" name="{{ md5('slug') }}" placeholder="tag slug...">
                    </div>
                    <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToCreate') }}">
                    <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('tag') }}">
                </form>
                <small id="add-tag" class="button-create disable-pointer-events btn bg-{{ $themeColor }} btn-sm click" value="form-create">Add new</small>
                <br>
                <br>
                <p class="smoke add-note">
                    <i>*Note:</i> Tag name and tag slug must contain only characters (a-z) or numbers,
                    can't contain any special characters (!, @, %, $, etc). Tag slug can't contain
                    space ' '.
                </p>
            </div>
        </div>
        <div class="col-sm-9">
            <div id="tag">
                <h5 class="text-center"><strong>All tags</strong></h5>
                <hr>
                <div class="tag-action auto">
                    <div class="action-selected left disable-pointer-events auto">
                        <ul class="action-selected disable-pointer-events menu-inline">
                            <span><strong>Action selected: </strong></span>
                            <li>
                                <select id="process-action" name="{{ md5('process-action') }}">
                                    <option value="{{ md5('trash') }}" class="main-action main-action-trash">Move to trash</option>
                                    <option value="{{ md5('remove') }}" class="main-action main-action-remove">Remove permanently</option>
                                </select>
                            </li>
                            <li><small class="click btn bg-{{ $themeColor }} btn-sm button-process" value="button-action">Process</small></li>
                        </ul>
                        <form id="form-process-action" role="form">
                            {!! csrf_field() !!}
                            <input type="hidden" name="{{ md5('process-option-trash') }}" value="{{ md5('yesIWantToTrash') }}">
                            <input type="hidden" name="{{ md5('process-option-remove') }}" value="{{ md5('yesIWantToRemove') }}">
                            <input type="hidden" name="{{ md5('process-option-status') }}" value="{{ md5('yesIWantToChangeStatus') }}">
                            <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('tag') }}">
                            <input id="trash-action" type="hidden" class="{{ md5('trash') }}">
                            <input id="remove-action" type="hidden" class="{{ md5('remove') }}">
                            <input id="id-action" type="hidden" class="{{ md5('id') }}">
                            <input id="status-action" type="hidden" class="{{ md5('status') }}">
                        </form>
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
                          <span><strong>Views per page: </strong></span>
                          <select>
                              <option id="pagiselect-20" class="sort" value="paginate-20">20</option>
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
                <div class="box-layout box-search-schedule auto">
                    <div class="left">
                        <h5 class="total-selected smoke">0 item selected</h5>
                    </div>
                    <div class="right">
                        <input id="search" class="form-control left" type="text" name="search" placeholder="Search tags...">
                        <small id="process-search" class="sort btn bg-{{ $themeColor }} btn-sm right" value="search">Search</small>
                    </div>
                </div>
                <div id="content" class="auto">
                    <div id="loading-content" class="loading text-center">
                        <img src="/admin/assets/icons/loading.gif" />
                        <p>Loading tags...</p>
                    </div>
                </div>
            </div>
            <div id="trash" class="trash">
                <div id="loading-trash" class="loading text-center">
                    <img src="/admin/assets/icons/loading.gif" />
                    <p>Loading trash...</p>
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
    .tag-content
    {
        background: rgb(246, 245, 245);
        padding: 8px;
        margin: 5px 10px 5px 0;
        border-radius: 5px 25px;
    }

    .tag-content:hover
    {
        border-radius: 0;
        box-shadow: 0 0 1px rgba(0, 0, 0, 0.5);
    }

    .tag-main-content
    {
        margin: 10px 0 0;
        width: auto;
    }

    .row-tag
    {
        margin-left: 6px;
        margin-right: 0;
    }

    .separator-tag
    {
        width: 100%;
        height: 1px;
        background: rgb(185, 185, 185);
        margin: 8px 0;
    }

    .small-text-tag
    {
        font-size: 13px;
    }

    .task-tag
    {
        padding: 10px 7px;
    }

    .tag-title
    {
        font-size: 16px;
    }
</style>
@endsection
