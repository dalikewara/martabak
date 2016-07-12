@extends('admin.master')

@section('title')
<title>{{ Auth::user()->username }} | Profile Setting</title>
@endsection

@section('header-title')
Profile setting
@endsection

@section('content')
<div class="main-content">
    <div class="setting-content">
        <div class="auto">
            <div class="auto layout-setting bg-smoke">
                <h3 class="layout-setting-title">Customize your profile</h3>
                <small>

                </small>
                <br>
                <br>
                <div class="form-group text-center">
                    <label>Profile picture:</label>
                    <div class="auto">
                        <img id="profile-picture" class="picture-layout" src="{{ $dir->url('pictures') }}/{{ Auth::user()->profile_picture }}" />
                        <input id="default-src-of-profile-picture" type="hidden" value="{{ $dir->url('pictures') }}/{{ Auth::user()->profile_picture }}">
                    </div>
                    <div id="picture-property" class="picture-layout">
                        <label id="change-picture" class="media-label media-click pointer" value="choose-profile-picture">Change Picture</label>
                    </div>
                    <div class="progress-layout progress-parent-profile-picture hide bg-white">
                        <div class="progress-inner progress-child-profile-child bg-{{ $themeColor }}">
                        </div>
                    </div>
                </div>
                <form class="main-setting-form" role="form">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">Fullname:</label>
                        <input class="form-control" type="text" name="{{ md5('profile-fullname') }}" value="{{ Auth::user()->fullname }}">
                        <small>
                            Enter or change your fullname here.
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="">Username:</label>
                        <input class="form-control" type="text" name="{{ md5('profile-username') }}" value="{{ Auth::user()->username }}">
                        <small>
                            Enter or change your username here.
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="">Email address:</label>
                        <input class="form-control" type="text" name="{{ md5('profile-email') }}" value="{{ Auth::user()->email }}">
                        <small>
                            Enter or change your e-mail address here.
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="">Display profile picture:</label>
                        @if(Auth::user()->display_profile_picture == 1)
                            <input type="radio" name="{{ md5('profile-display-profile-picture') }}" value="{{ md5('yes') }}" checked> Yes (default)
                            <input type="radio" name="{{ md5('profile-display-profile-picture') }}" value="{{ md5('no') }}"> No
                        @else
                            <input type="radio" name="{{ md5('profile-display-profile-picture') }}" value="{{ md5('yes') }}"> Yes (default)
                            <input type="radio" name="{{ md5('profile-display-profile-picture') }}" value="{{ md5('no') }}" checked> No
                        @endif
                        <br>
                        <small>
                            Most users want to display their profile picture. If you are not, change the radio button to "No".
                        </small>
                    </div>
                    <input id="input-profile-picture" type="hidden" name="{{ md5('profile-picture') }}">
                    <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToSetting') }}">
                    <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('profile') }}">
                </form>
            </div>
        </div>
        <div class="auto">
            <div class="auto layout-setting-clear text-right">
                <small class="btn btn-sm click bg-{{ $themeColor }}" value="save-profile">Save setting</small>
                <small class="btn btn-no btn-sm click" value="out-profile">Out</small>
            </div>
        </div>
        <p id="alert" class="alert alert-danger none">There are some errors</p>
    </div>
</div>
<div id="dark-div-profile" class="dark-div none">
</div>
<div id="media-menu-profile" class="media-menu none">
    <div class="media-menu-inner bg-white shadow">
        <div class="media-header">
            <div class="media-menu-title text-center bg-white">
                <h3>Choose Profile Picture</h3>
                <hr>
            </div>
            <div class="media-menu-panel-top bg-white">
                <form id="form-upload-profile-picture" role="form" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input id="select-profile-picture" class="hide upload" name="{{ md5('name') }}" type="file" multiple/>
                    <label id="upload-profile-picture" class="pointer media-label" for="select-profile-picture"><span class="glyphicon glyphicon-plus"></span> Upload new</label>
                    <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToUpload') }}">
                    <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('picture') }}">
                </form>
                <hr>
            </div>
        </div>
        <div class="auto media-menu-content bg-smoke">
            <div id="load-profile-picture">
                <div id="loading-profile-picture" class="loading text-center">
                    <img src="/martabak-frontend/admin/assets/icons/loading.gif" />
                    <p>Loading profile pictures...</p>
                </div>
            </div>
        </div>
        <br>
        <div class="media-footer text-right">
            <small class="btn btn-no btn-sm media-click" value="close-profile-picture">Close</small>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{ $dir->url('admin-scripts') }}/settings.js"></script>
@endsection

@section('style')
<style media="screen">
#profile-picture
{
    border: 8px solid white;
    border-radius: 5px 5px 0 0;
}

#picture-property
{
    background: white;
    margin: 0 auto;
    height: 30px;
    padding: 5px;
    border-radius: 0 0 5px 5px;
}

.picture-layout
{
    width: 200px;
    height: 200px;
    box-shadow: 0 0 2px rgba(0, 0, 0, 0.5);
}

.task-media
{
    margin: 0 0 10px;
}
</style>
@endsection
