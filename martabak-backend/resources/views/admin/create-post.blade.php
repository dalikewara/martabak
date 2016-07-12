@extends('admin.master')

@section('title')
<title>{{ Auth::user()->username }} | Create Post</title>
@endsection

@section('style')
<link rel="stylesheet" href="/martabak-frontend/admin/assets/stylesheets/create-post.layout.css" type="text/css">
@endsection

@section('header-title')
Write your post...
@endsection

@section('content')
<div class="main-content auto">
    <form id="form-create" role="form" method="POST">
        {!! csrf_field() !!}
        <div id="head-post" class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <input id="post-title" class="input-create-title" type="text" name="{{ md5('name') }}" placeholder="Enter post title...">
                </div>
            </div>
            <div class="col-sm-6">
                <span style="color: rgb(92, 92, 92)"><strong>Slug:</strong> http://www.dalikewara.id/blog/post/<span><input id="post-slug" class="input-create-slug" type="text" name="{{ md5('slug') }}" placeholder="..."></span></span>
            </div>
        </div>
        <div id="textarea-content" class="form-group" value="{{ md5('content') }}">
            <textarea class="content-textarea" rows="16" cols="40"></textarea>
        </div>
        <div id="post-attribute" class="row">
            <div class="attribute col-sm-3">
                <p><strong>Insert Media</strong></p>
                <div class="media-box">
                    <div id="div-media">
                        <div id="loading-media" class="loading-media text-center none">
                            <img src="/admin/assets/icons/loading.gif" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="attribute col-sm-3">
                <p><strong>Tags</strong></p>
                <div class="attr-box">
                    <div id="div-tag">
                        <div id="loading-tag" class="loading-tag text-center none">
                            <img src="/admin/assets/icons/loading.gif" />
                        </div>
                    </div>
                </div>
                <br>
                <p><strong>Categories</strong></p>
                <div class="attr-box">
                    <div id="div-category">
                        <div id="loading-category" class="loading-category text-center none">
                            <img src="/admin/assets/icons/loading.gif" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="attribute col-sm-3">
                <p><strong>Date publish</strong></p>
                <div class="form-group">
                    <input id="auto-date-click" type="radio" name="{{ md5('date-publish') }}" value="auto" checked> Auto (default)
                    <br>
                    <input id="custom-date-click" type="radio" name="{{ md5('date-publish') }}" value="custom"> Custom
                </div>
                <div class="form-group">
                    <div id="custom-date" class="disable-pointer-events">
                        <div class="custom-date-date form-group">
                            <input id="input-custom-date" class="form-control" type="text" name="{{ md5('custom-date') }}" value="" placeholder="Set custom date...">
                            <span style="color: rgb(153, 153, 153); font-size: 12px">Format: Y-m-d | Example: 2016-01-31</span>
                        </div>
                        <div class="custom-date-time form-group">
                            <input id="input-custom-time" class="form-control" type="text" name="{{ md5('custom-time') }}" value="" placeholder="Set custom time...">
                            <span style="color: rgb(153, 153, 153); font-size: 12px">Format: H:i | Example: 15:00 or 09:00</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="attribute col-sm-3">
                <p><strong>Post settings:</strong></p>
                <div class="form-group">
                    <input type="radio" name="{{ md5('comment-role') }}" value="{{ md5('yesAllowed') }}" checked> Allow comment (default)
                    <br>
                    <input type="radio" name="{{ md5('comment-role') }}" value="{{ md5('notAllowed') }}"> Don't allow comment
                </div>
            </div>
        </div>
        <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToCreate') }}">
        <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('post') }}">
    </form>
    <div id="button-layout" value="{{ md5('content-status') }}">
        <small id="create-createDraft-post" type="button" class="btn btn-warning btn-sm createClick" value="{{ md5('yesIWantToDraft') }}">Save draft</small>
        <small id="create-createPublish-post" type="button" class="btn btn-primary btn-sm createClick" value="{{ md5('yesIWantToPublish') }}">Publish</small>
        <small id="createOut-post" type="button" class="btn btn-no btn-sm createClick">Out</small>
    </div>
    <p id="alert" class="alert alert-danger hide"><strong>Ups!</strong> There are some errors when processing this post.</p>
</div>
@endsection

@section('script')
{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
<script type="text/javascript" src="/martabak-frontend/admin/assets/plugins/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="/martabak-frontend/admin/assets/scripts/create.js"></script>
<script type="text/javascript">
    tinymce.init(
    {
        selector: "textarea",
        theme: "modern",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern imagetools"
        ],
        toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
        toolbar2: "print preview media | forecolor backcolor emoticons",
        image_advtab: true,
        templates: [
            {title: 'Test template 1', content: 'Test 1'},
            {title: 'Test template 2', content: 'Test 2'}
        ],
        relative_urls: false
    });
</script>
@endsection
