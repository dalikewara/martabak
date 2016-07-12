@extends('admin.master')

@section('title')
<title>{{ Auth::user()->username }} | Appearances Setting</title>
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
                <div class="auto layout-setting">
                    <h3 class="layout-setting-title">Homeland theme color</h3>
                    <small class="black">
                        There are more than 5 free colors available for your homeland page.
                    </small>
                    <br>
                    <br>
                    <?php
                        $colorNumber = 1;
                        $bgColors    = array('black', 'orange', 'red', 'green', 'blue', 'yellow');
                    ?>
                    @foreach($bgColors as $bgColor)
                        <div class="left text-center main-box-theme-color auto transition pointer">
                            @if($themeColor == $bgColor)
                                <input class="pointer" type="radio" name="{{ md5('main-theme-color') }}" value="{{ md5($bgColor) }}" checked><small class="color-number">{{ $colorNumber }}</small><div class="bg-{{ $bgColor }} box-theme-color"><p class="black bg-white">Selected</p></div>
                            @else
                                <input class="pointer" type="radio" name="{{ md5('main-theme-color') }}" value="{{ md5($bgColor) }}"><small class="color-number">{{ $colorNumber }}</small><div class="bg-{{ $bgColor }} box-theme-color white"></div>
                            @endif
                        </div>
                        <?php $colorNumber++; ?>
                    @endforeach
                </div>
            </div>
            <div class="auto">
                <div class="auto layout-setting bg-smoke">
                    <h3 class="layout-setting-title">Layout</h3>
                    <div class="form-group">
                        <label for="">Header position:</label>
                        @if($layout->header_position == 'header-top')
                            <input type="radio" name="{{ md5('header-position') }}" value="{{ md5('header-top') }}" checked> Top (default)
                            <input type="radio" name="{{ md5('header-position') }}" value="{{ md5('header-bottom') }}"> Bottom
                        @else
                            <input type="radio" name="{{ md5('header-position') }}" value="{{ md5('header-top') }}"> Top (default)
                            <input type="radio" name="{{ md5('header-position') }}" value="{{ md5('header-bottom') }}" checked> Bottom
                        @endif
                        <br>
                        <small class="black">
                            You can set up position of header panel by "top" or "bottom". Default is "top".
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="">Navigation position:</label>
                        @if($layout->navigation_position == 'navigation-right')
                            <input type="radio" name="{{ md5('navigation-position') }}" value="{{ md5('navigation-right') }}" checked> Right (default)
                            <input type="radio" name="{{ md5('navigation-position') }}" value="{{ md5('navigation-left') }}"> Left
                        @else
                            <input type="radio" name="{{ md5('navigation-position') }}" value="{{ md5('navigation-right') }}"> Right (default)
                            <input type="radio" name="{{ md5('navigation-position') }}" value="{{ md5('navigation-left') }}" checked> Left
                        @endif
                        <br>
                        <small class="black">
                            You can set up position of navigation panel by "right" or "left". Default is "right".
                        </small>
                    </div>
                </div>
            </div>
            <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToSetting') }}">
            <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('appearance') }}">
        </form>
        <div class="auto">
            <div class="auto layout-setting-clear text-right">
                <small class="btn bg-{{ $themeColor }} btn-sm click" value="save-appearances">Save Setting</small>
                <small class="btn btn-danger btn-sm click" value="out-appearances">Out</small>
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
    .color-number
    {
        margin: 0 2px;
    }

    .main-box-theme-color
    {
        width: 80px;
        margin: 0 10px 10px;
        box-shadow: 0 0 4px rgba(0, 0, 0, 0.5);
        border-radius: 2px;
    }

    .main-box-theme-color:hover
    {
        box-shadow: 0 0 1px rgba(0, 0, 0, 0.3);
    }

    .box-theme-color
    {
        width: 80px;
        height: 80px;
        border-radius: 2px;
    }
</style>
@endsection
