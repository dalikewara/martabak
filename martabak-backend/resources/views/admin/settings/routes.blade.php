@extends('admin.master')

@section('title')
<title>{{ Auth::user()->username }} | Routes Setting</title>
@endsection

@section('header-title')
General setting
@endsection

@section('content')
<div class="main-content">
    <div class="setting-content">
        <form class="main-setting-form" role="form">
            {!! csrf_field() !!}
            <div class="auto">
                <div class="auto layout-setting bg-smoke">
                    <h3 class="layout-setting-title">Manage routes url</h3>
                    <small>
                        You can manage routes for your website. But, you have to be carefull. If you have
                        duplicate url (your route url same as with your content urls),
                        it will being crashed. <strong>Please add '/' at the front of url</strong>, because the right format is: <strong>/your-url-here</strong>.
                    </small>
                    <br>
                    <br>
                    <div class="form-group">
                        <label for="">Homeland route:</label> <small class="smoke">Default is "/homeland"</small>
                        <input class="form-control route-input route-input-homeland" type="text" name="{{ md5('homeland-route') }}" value="{{ $route->homeland_route }}" placeholder="null">
                        <small class="route-url">
                            Url: <span class="smoke">www.</span><span class="host-url"></span><span class="path-url">{{ $route->homeland_route }}</span>
                        </small>
                        <br>
                        <small>
                            This is your homeland (admin) page url. It can't be <i>null</i>.
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="">Post route:</label> <small class="smoke">Default is "/post"</small>
                        <input class="form-control route-input" type="text" name="{{ md5('post-route') }}" value="{{ $route->post_route }}" placeholder="null">
                        <small class="route-url">
                            Url: <span class="smoke">www.</span><span class="host-url"></span><span class="path-url">{{ $route->post_route }}</span>/<span class="smoke">your-post-slug-here</span>
                        </small>
                        <br>
                        <small>
                            This is for post url.
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="">Tag route:</label> <small class="smoke">Default is "/tag"</small>
                        <input class="form-control route-input" type="text" name="{{ md5('tag-route') }}" value="{{ $route->tag_route }}" placeholder="null">
                        <small class="route-url">
                            Url: <span class="smoke">www.</span><span class="host-url"></span><span class="path-url">{{ $route->tag_route }}</span>/<span class="smoke">your-tag-slug-here</span>
                        </small>
                        <br>
                        <small>
                            This is for tag url of your content(post).
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="">Category route:</label> <small class="smoke">Default is "/category"</small>
                        <input class="form-control route-input" type="text" name="{{ md5('category-route') }}" value="{{ $route->category_route }}" placeholder="null">
                        <small class="route-url">
                            Url: <span class="smoke">www.</span><span class="host-url"></span><span class="path-url">{{ $route->category_route }}</span>/<span class="smoke">your-category-slug-here</span>
                        </small>
                        <br>
                        <small>
                            This is for category url of your content(post).
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="">Page route:</label> <small class="smoke">Default is null</small>
                        <input class="form-control route-input" type="text" name="{{ md5('page-route') }}" value="{{ $route->page_route }}" placeholder="null">
                        <small class="route-url">
                            Url: <span class="smoke">www.</span><span class="host-url"></span><span class="path-url">{{ $route->page_route }}</span>/<span class="smoke">your-page-slug-here</span>
                        </small>
                        <br>
                        <small>
                            This is for your page url.
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="">Media route:</label> <small class="smoke">Default is "/media"</small>
                        <input class="form-control route-input" type="text" name="{{ md5('media-route') }}" value="{{ $route->media_route }}" placeholder="null">
                        <small class="route-url">
                            Url: <span class="smoke">www.</span><span class="host-url"></span><span class="path-url">{{ $route->media_route }}</span>/<span class="smoke">your-media-slug-here</span>
                        </small>
                        <br>
                        <small>
                            This is for media url of your content(post).
                        </small>
                    </div>
                </div>
            </div>
            <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToSetting') }}">
            <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('route') }}">
        </form>
        <div class="auto">
            <div class="auto layout-setting-clear text-right">
                <small class="btn bg-{{ $themeColor }} btn-sm click" value="save-routes">Save Setting</small>
                <small class="btn btn-danger btn-sm click" value="out-routes">Out</small>
            </div>
        </div>
        <p id="alert" class="alert alert-danger none">There are some errors</p>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{ $dir->url('admin-scripts') }}/settings.js"></script>
@endsection

@section('style')
<style media="screen">
</style>
@endsection
