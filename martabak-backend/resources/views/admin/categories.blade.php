@extends('admin.master')

@section('title')
<title>{{ Auth::user()->username }} | Categories</title>
@endsection

@section('header-title')
Manage categories of your contents
@endsection

@section('content')
<div class="main-content">
    <div class="row">
        <div class="col-sm-3">
            <div class="left">
                <p class="black">
                    Manage your categories, use "Action selected" to execute some works.
                    You can sort categories by using options on the right.
                </p>
                <hr>
            </div>
            <div class="">
                <h5><strong>Add new category</strong></h5>
                <hr>
                <p class="smoke">
                  By default, "Category slug" will be filled automatically when you typing on the category name.
                  Otherwise, you can set it manually.
                </p>
                <form id="form-create" role="form">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <input class="create-input input-name form-control" type="text" name="{{ md5('name') }}" placeholder="Enter category name...">
                    </div>
                    <div class="form-group">
                        <input class="create-input input-slug form-control" type="text" name="{{ md5('slug') }}" placeholder="Category slug...">
                    </div>
                    <div class="form-group">
                        <textarea class="create-input form-control" name="{{ md5('description') }}" rows="4" placeholder="Enter category description..."></textarea>
                    </div>
                    <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToCreate') }}">
                    <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('category') }}">
                </form>
                <small id="add-category" class="button-create btn bg-{{ $themeColor }} btn-sm click" value="form-create">Add new</small>
                <br>
                <br>
                <p class="smoke add-note">
                    <i>*Note:</i> Category description is used to describe your category.
                    It will appears on the list. But, some themes may not able to show it on your website.
                    <br>
                    Category name and category slug must contain only characters (a-z) or numbers,
                    can't contain any special characters (!, @, %, $, etc). Category name can
                    contain '&'. Category slug can't contain
                    space ' '.
                </p>
            </div>
        </div>
        <div class="col-sm-9">
            <div id="category">
                <h5 class="text-center"><strong>All categories</strong></h5>
                <hr>
                <div class="category-action auto">
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
                            <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('category') }}">
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
                <div class="box-layout box-search-schedule auto">
                    <div class="left">
                        <h5 class="total-selected smoke">0 item selected</h5>
                    </div>
                    <div class="right">
                        <input id="search" class="form-control left" type="text" name="search" placeholder="Search categories...">
                        <small id="process-search" class="sort btn bg-{{ $themeColor }} btn-sm right" value="search">Search</small>
                    </div>
                </div>
                <div id="content">
                    <div id="loading-content" class="loading text-center">
                        <img src="/admin/assets/icons/loading.gif" />
                        <p>Loading categories...</p>
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
<!-- <link rel="stylesheet" href="/views/admin-themes/homeland/developer-only/stylesheet/categories.layout.css" type="text/css"> -->
<style media="screen">
    #check
    {
        width: 1%;
    }

    #category-box
    {
        margin: 10px 0;
    }

    #category-bottom
    {
        margin: 0 0 20px;
    }

    .tasks
    {
        margin: 0 5px;
    }

    .menu-edit, .menu-delete
    {
        display: none;
    }

    .menu-delete
    {
        position: absolute;
        z-index: 1;
    }

    .edit-category, .trash-category, .remove-category
    {
        cursor: pointer;
    }

    .th-checkbox
    {
        width: 1%;
    }

    .th-name
    {
        width: 15%;
    }

    .th-description
    {
        width: 48%;
    }

    .th-relation
    {
        width: 22%;
    }


</style>
@endsection
