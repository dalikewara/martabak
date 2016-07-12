@extends('admin.master')

@section('title')
<title>{{ Auth::user()->username }} | Create page</title>
@endsection

@section('header-title')
Build your own page
@endsection

@section('content')
<div class="main-content">
    <div class="row">
        <div class="col-sm-12">
            <div class="left">
                <p class="smooth-black">
                    For creating your page, there are some options you can use.
                    If your theme has support for "default" page view
                    and you won't to use it, you can using "custom" feature
                    that allows you to create your custom page&mdash;you need to
                    code.
                </p>
                <hr>
            </div>
        </div>
        <div class="col-sm-4">
            <p><strong>Insert Media</strong></p>
            <div class="media-box">
                <div id="div-media">
                    <div id="loading-media" class="loading-media text-center none">
                        <img src="/admin/assets/icons/loading.gif" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="">
                <strong>Date publish :</strong>
                <!-- <input class="click" type="radio" name="date-publish" value="auto-date" checked> Auto (default)
                <input class="click" type="radio" name="date-publish" value="custom-date"> Custom -->
                <input id="auto-date-click" type="radio" name="{{ md5('date-publish') }}" value="auto" checked> Auto (default)
                <input id="custom-date-click" type="radio" name="{{ md5('date-publish') }}" value="custom"> Custom
                <div id="custom-date" class="disable-pointer-events">
                    <div class="custom-date-date form-group">
                        <input id="input-custom-date" class="form-control" type="text" name="{{ md5('custom-date') }}" placeholder="Set custom date...">
                        <span style="color: rgb(153, 153, 153); font-size: 12px">Format: Y-m-d | Example: 2016-01-31</span>
                    </div>
                    <div class="custom-date-time form-group">
                        <input id="input-custom-time" class="form-control" type="text" name="{{ md5('custom-time') }}" placeholder="Set custom time...">
                        <span style="color: rgb(153, 153, 153); font-size: 12px">Format: H:i | Example: 15:00 or 09:00</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="">
                <form id="form-create" role="form">
                    {!! csrf_field() !!}
                    <strong>Page title :</strong> <input id="input-name" class="input" type="text" name="{{ md5('name') }}">
                    <br>
                    <strong>Page slug :</strong> <input id="input-slug" class="input" type="text" name="{{ md5('slug') }}">
                    <br>
                    <strong>Comment :</strong> <input class="" type="radio" name="{{ md5('comment-role') }}" value="{{ md5('yesAllowed') }}" checked> Allow (default) <input class="" type="radio" name="{{ md5('comment-role') }}" value="{{ md5('notAllowed') }}"> Don't allow
                    <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToCreate') }}">
                    <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('page') }}">
                </form>
                <input id="input-type-page-custom" type="hidden" name="{{ md5('type-page') }}" value="{{ md5('custom') }}">
                <input id="input-type-page-default" type="hidden" name="{{ md5('type-page') }}" value="{{ md5('default') }}">
            </div>
        </div>
        <div class="col-sm-12">
            <hr>
        </div>
        <div class="col-sm-12 text-center auto">
            <span id="default-page" class="page-select page-active createClick pointer" value="default"><strong>Default</strong></span>
            <span id="custom-page" class="page-select page-unactive createClick pointer" value="custom"><strong>Custom</strong></span>
            <hr>
        </div>
        <div class="col-sm-12 box-content">
            <input id="textarea-content" type="hidden" value="{{ md5('content') }}">
            <div id="default-content">
                <textarea class="textarea-content textarea-default-content" name="name" rows="20"></textarea>
            </div>
            <div id="custom-content">
                <textarea class="textarea-content textarea-custom-content" name="name" rows="20"></textarea>
            </div>
        </div>
        <div class="col-sm-12">

        </div>
        <div class="col-sm-12 auto text-right button-bottom">
            <div id="button-layout" value="{{ md5('content-status') }}">
                <small id="create-createDraft-page" type="button" class="btn btn-warning btn-sm createClick" value="{{ md5('yesIWantToDraft') }}">Save draft</small>
                <small id="create-createPublish-page" type="button" class="btn btn-primary btn-sm createClick" value="{{ md5('yesIWantToPublish') }}">Publish</small>
                <small id="createOut-page" type="button" class="btn btn-no btn-sm createClick">Out</small>
            </div>
        </div>
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
        selector: "textarea.textarea-default-content",
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

    // function ajax(url, data, element, content)
    // {
    //     $.ajax(
    //     {
    //         url: url,
    //         data: data,
    //         type: 'POST',
    //         success: function(report)
    //         {
    //             if(report == 'success')
    //             {
    //                 switch(element)
    //                 {
    //                     case 'publish':
    //                         $('#alert').text('Trash: success.');
    //                         break;
    //
    //                     case 'draft':
    //                         $('#alert').text('Trash: success.');
    //                         break;
    //
    //                     default:
    //                         break;
    //                 }
    //
    //                 $('#alert').removeClass('alert-danger').addClass('alert-success').fadeIn(function()
    //                 {
    //                     $('.main-content').animate({opacity: 0.3}).addClass('disable-pointer-events');
    //                 }).fadeOut(function()
    //                 {
    //                     window.location.href = $mainUrl + $content;
    //                 });
    //             }
    //             else
    //             {
    //                 $('#alert').removeClass('alert-success alert-danger').addClass('alert-danger').fadeIn();
    //                 document.getElementById('alert').innerHTML = report;
    //             }
    //
    //             $('.button-process, .button-create').text('Process').animate({opacity: 1}).removeClass('disable-pointer-events');
    //         }
    //     });
    // }
</script>
@endsection

@section('style')
<style media="screen">
    #custom-content
    {
        display: none;
    }

    /*global*/
    #custom-date
    {
        margin: 8px 0 0;
        opacity: 0.5;
    }

    .input
    {
        border-top: none;
        border-left: none;
        border-right: none;
        background: transparent;
        margin: 5px 0 10px;
        width: 100%;
        border-bottom: 1px dashed rgb(48, 105, 18);
        padding: 0 10px;
    }

    .page-select
    {
        transition: all 1s;
    }

    .page-select:hover
    {
        /*text-shadow: 0 0 4px rgb(48, 105, 18);
        color: rgb(48, 105, 18);*/
        text-shadow: 0 0 4px rgba(0, 0, 0, 0.5);
        opacity: 0.8;
    }

    .textarea-content
    {
        width: 100%;
    }

    .textarea-custom-content
    {
        background: rgb(35, 35, 42);
        padding: 15px;
        font-size: 14px;
        font-family: sans-serif;
    }

    .page-unactive, .page-active
    {
        padding: 10px;
        border-radius: 2px;
    }

    .page-active
    {
        border-bottom: 2px solid rgb(48, 105, 18);
        text-shadow: 0 0 4px rgb(48, 105, 18);
        color: rgb(48, 105, 18);
    }

    .page-unactive
    {
        border-bottom: 2px solid rgb(212, 207, 207);
    }

    .button-bottom
    {
        margin: 10px 0;
    }

    /*pre code .string {
    color:#A1E46D;
}
pre code .special {
    color:#D6665D;
}
pre code .special-js {
    color:#6DE4D1;
}
pre code .special-js-glob {
    color:#A1E46D;
    font-weight:bold;
}
pre code .special-comment{
    color:#aaa;
}
pre code .special-js-meth {
    color:#E46D8A;
}
pre code .special-html {
    color:#E4D95F;
}
pre code .special-sql {
    color:#1D968C;
}
pre code .special-php{
    color:#597EA7;
}*/
</style>
@endsection
