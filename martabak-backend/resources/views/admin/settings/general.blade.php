@extends('admin.master')

@section('title')
<title>{{ Auth::user()->username }} | General Settings</title>
@endsection

@section('header-title')
General settings
@endsection

@section('content')
<div class="main-content">
    <div class="setting-content">
        <form class="main-setting-form" role="form">
            {!! csrf_field() !!}
            <div class="auto">
                <div class="auto layout-setting bg-smoke">
                    <h3 class="layout-setting-title">Website</h3>
                    <div class="form-group">
                        <label>Title:</label>
                        <input class="form-control" type="text" name="{{ md5('website-title') }}" value="{{ $website->title }}">
                        <small>
                            Your website title, it appears on the Browser's tab.
                        </small>
                    </div>
                    <div class="form-group">
                        <label>Heading:</label>
                        <input class="form-control" type="text" name="{{ md5('website-heading') }}" value="{{ $website->heading }}">
                        <small>
                            Your website name, placed in the HTML "h1" tag.
                        </small>
                    </div>
                    <div class="form-group">
                        <label>Slogan:</label>
                        <input class="form-control" type="text" name="{{ md5('website-slogan') }}" value="{{ $website->slogan }}">
                        <small>
                            A few words to describe or explain your website.
                        </small>
                    </div>
                    <div class="form-group">
                        <label>HTML meta:</label>
                        <textarea class="form-control" name="{{ md5('website-html-meta') }}" rows="8" cols="40">{{ $website->meta }}</textarea>
                        <small>
                            A quick way to add HTML metas to your website.
                        </small>
                    </div>
                </div>
            </div>
            <div class="auto">
                <div class="auto layout-setting bg-smoke">
                    <h3 class="layout-setting-title">Contents</h3>
                    <div class="form-group">
                        <label for="">Show post:</label>
                        @if($contentSetting->show_post == 1)
                            <input type="radio" name="{{ md5('content-show-post') }}" value="{{ md5('yes') }}" checked> Yes (default)
                            <input type="radio" name="{{ md5('content-show-post') }}" value="{{ md5('no') }}"> No <br>
                        @else
                            <input type="radio" name="{{ md5('content-show-post') }}" value="{{ md5('yes') }}"> Yes (default)
                            <input type="radio" name="{{ md5('content-show-post') }}" value="{{ md5('no') }}" checked> No <br>
                        @endif
                        <small>
                            Show or hide post from your website.
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="">Posts per page:</label> <small class="smoke">Default is 10</small>
                        <input class="form-control" type="text" name="{{ md5('content-posts-per-page') }}" value="{{ $contentSetting->posts_per_page }}">
                        <small>
                            The number of posts to be displayed on your website.
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="">Show article as:</label>
                        @if($contentSetting->show_article_as == 1)
                            <input type="radio" name="{{ md5('content-show-article-as') }}" value="{{ md5('summary') }}" checked> Summary (default)
                            <input type="radio" name="{{ md5('content-show-article-as') }}" value="{{ md5('fulltext') }}"> Full text <br>
                        @else
                            <input type="radio" name="{{ md5('content-show-article-as') }}" value="{{ md5('summary') }}"> Summary (default)
                            <input type="radio" name="{{ md5('content-show-article-as') }}" value="{{ md5('fulltext') }}" checked> Full text <br>
                        @endif
                        <small>
                            Summary means, your article only takes some words
                            or content to be displayed, you will see "read more" button or similiar. Full text means, your article
                            will take the full content.
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="">Show tag:</label>
                        @if($contentSetting->show_tag == 1)
                            <input type="radio" name="{{ md5('content-show-tag') }}" value="{{ md5('yes') }}" checked> Yes (default)
                            <input type="radio" name="{{ md5('content-show-tag') }}" value="{{ md5('no') }}"> No <br>
                        @else
                            <input type="radio" name="{{ md5('content-show-tag') }}" value="{{ md5('yes') }}"> Yes (default)
                            <input type="radio" name="{{ md5('content-show-tag') }}" value="{{ md5('no') }}" checked> No <br>
                        @endif
                        <small>
                            If you want to keep tag displayed on each post, check the radio button to "yes".
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="">Show category:</label>
                        @if($contentSetting->show_category == 1)
                            <input type="radio" name="{{ md5('content-show-category') }}" value="{{ md5('yes') }}" checked> Yes (default)
                            <input type="radio" name="{{ md5('content-show-category') }}" value="{{ md5('no') }}"> No <br>
                        @else
                            <input type="radio" name="{{ md5('content-show-category') }}" value="{{ md5('yes') }}"> Yes (default)
                            <input type="radio" name="{{ md5('content-show-category') }}" value="{{ md5('no') }}" checked> No <br>
                        @endif
                        <small>
                            If you want to keep category displayed on each post, check the radio button to "yes".
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="">Show media:</label>
                        @if($contentSetting->show_media == 1)
                            <input type="radio" name="{{ md5('content-show-media') }}" value="{{ md5('yes') }}" checked> Yes (default)
                            <input type="radio" name="{{ md5('content-show-media') }}" value="{{ md5('no') }}"> No <br>
                        @else
                            <input type="radio" name="{{ md5('content-show-media') }}" value="{{ md5('yes') }}"> Yes (default)
                            <input type="radio" name="{{ md5('content-show-media') }}" value="{{ md5('no') }}" checked> No <br>
                        @endif
                        <small>
                            If you want to keep media content displayed on each post, check the radio button to "yes".
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="">Default post category:</label>
                        <select name="{{ md5('content-default-post-category') }}">
                            <option value="Uncategorized">Uncategorized</option>
                        </select>
                        <br>
                        <small>
                            Set default category of your post which made without it.
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="">Allow post comment:</label>
                        @if($contentSetting->allow_post_comment == 1)
                            <input type="radio" name="{{ md5('content-allow-post-comment') }}" value="{{ md5('yes') }}" checked> Yes (default)
                            <input type="radio" name="{{ md5('content-allow-post-comment') }}" value="{{ md5('no') }}"> No <br>
                        @else
                            <input type="radio" name="{{ md5('content-allow-post-comment') }}" value="{{ md5('yes') }}"> Yes (default)
                            <input type="radio" name="{{ md5('content-allow-post-comment') }}" value="{{ md5('no') }}" checked> No <br>
                        @endif
                        <small>
                            Check the radio button to yes to allow people leave comment on each post.
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="">Allow page comment:</label>
                        @if($contentSetting->allow_page_comment == 1)
                            <input type="radio" name="{{ md5('content-allow-page-comment') }}" value="{{ md5('yes') }}" checked> Yes (default)
                            <input type="radio" name="{{ md5('content-allow-page-comment') }}" value="{{ md5('no') }}"> No <br>
                        @else
                            <input type="radio" name="{{ md5('content-allow-page-comment') }}" value="{{ md5('yes') }}"> Yes (default)
                            <input type="radio" name="{{ md5('content-allow-page-comment') }}" value="{{ md5('no') }}" checked> No <br>
                        @endif
                        <small>
                            Check the radio button to yes to allow people leave comment on each page.
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="">Comment configuration:</label>
                        @if($contentSetting->comment_configuration == 1)
                            <input type="radio" name="{{ md5('content-comment-configuration') }}" value="{{ md5('manual') }}" checked> Manual (default)
                            <input type="radio" name="{{ md5('content-comment-configuration') }}" value="{{ md5('auto') }}"> Auto<br>
                        @else
                            <input type="radio" name="{{ md5('content-comment-configuration') }}" value="{{ md5('manual') }}"> Manual (default)
                            <input type="radio" name="{{ md5('content-comment-configuration') }}" value="{{ md5('auto') }}" checked> Auto<br>
                        @endif
                        <small>
                            If you choose "Manual"
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="">Comment moderation:</label> <small class="black">Separate by coma</small>
                        <textarea class="form-control" name="{{ md5('content-comment-moderation') }}" rows="8" cols="40"></textarea>
                        <small>
                          Moderate comment automatically if it contains any contents of the textarea(comment moderation's box).
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="">Comment blacklist:</label> <small class="black">Separate by coma</small>
                        <textarea class="form-control" name="{{ md5('content-comment-blacklist') }}" rows="8" cols="40"></textarea>
                        <small>
                          Blacklist comment automatically if it contains any contents of the textarea(comment moderation's box).
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="">Display picture for commenters:</label>
                        @if($contentSetting->display_picture_for_commenters == 1)
                            <input type="radio" name="{{ md5('content-display-picture-for-commenters') }}" value="{{ md5('yes') }}" checked> Yes (default)
                            <input type="radio" name="{{ md5('content-display-picture-for-commenters') }}" value="{{ md5('no') }}"> No <br>
                        @else
                            <input type="radio" name="{{ md5('content-display-picture-for-commenters') }}" value="{{ md5('yes') }}"> Yes (default)
                            <input type="radio" name="{{ md5('content-display-picture-for-commenters') }}" value="{{ md5('no') }}" checked> No <br>
                        @endif
                        <small>
                            If you check the radio button to "yes", people who comment will have a picture.
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="">Default commenters picture:</label>
                        <br>
                        <div class="form-group">
                            @if($contentSetting->default_commenters_picture == 'anonim')
                                <input type="radio" name="{{ md5('content-default-commenters-picture') }}" value="anonim" checked>
                            @else
                                <input type="radio" name="{{ md5('content-default-commenters-picture') }}" value="anonim">
                            @endif
                            <img src="/martabak-frontend/admin/assets/images/default.png" width="60" /> Anonim (Default)
                        </div>
                        <div class="form-group">
                            @if($contentSetting->default_commenters_picture == 'monster-1')
                                <input type="radio" name="{{ md5('content-default-commenters-picture') }}" value="monster-1" checked>
                            @else
                                <input type="radio" name="{{ md5('content-default-commenters-picture') }}" value="monster-1">
                            @endif
                            <img src="/martabak-frontend/admin/assets/images/monster-1.png" width="60" /> Monster 1
                        </div>
                        <div class="form-group">
                            @if($contentSetting->default_commenters_picture == 'monster-2')
                                <input type="radio" name="{{ md5('content-default-commenters-picture') }}" value="monster-2" checked>
                            @else
                                <input type="radio" name="{{ md5('content-default-commenters-picture') }}" value="monster-2">
                            @endif
                            <img src="/martabak-frontend/admin/assets/images/monster-2.png" width="60" /> Monster 2
                        </div>
                        <div class="form-group">
                            @if($contentSetting->default_commenters_picture == 'monster-3')
                                <input type="radio" name="{{ md5('content-default-commenters-picture') }}" value="monster-3" checked>
                            @else
                                <input type="radio" name="{{ md5('content-default-commenters-picture') }}" value="monster-3">
                            @endif
                            <img src="/martabak-frontend/admin/assets/images/monster-3.png" width="60" /> Monster 3
                        </div>
                        <small>
                            Choose default picture for commenters.
                        </small>
                    </div>
                </div>
            </div>
            <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToSetting') }}">
            <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('general') }}">
        </form>
        <div class="auto">
            <div class="auto layout-setting-clear text-right">
                <small class="btn bg-{{ $themeColor }} btn-sm click" value="save-general">Save Setting</small>
                <small class="btn btn-danger btn-sm click" value="save-general">Out</small>
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
