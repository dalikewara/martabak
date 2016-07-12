@extends('admin.master')

@section('title')
<title>{{ Auth::user()->username }} | Dashboard</title>
@endsection

@section('header-title')
Take a look for your overview
@endsection

@section('content')
<div class="main-content">
    <div class="row parent-layout">
        <div class="col-sm-4">
            <div class="child-layout">
                <h4 class="text-center">Website Info</h4>
                <hr>

            </div>
        </div>
        <div class="col-sm-4">
            <div class="child-layout text-center">
                <h4 class="text-center">Content Info</h4>
                <hr>
                <h5>
                    <span class="glyphicon glyphicon-leaf"></span>
                    @if(count($contents->posts->all()) < 2)
                        <strong>{{ count($contents->posts->all()) }}</strong> Post
                    @else
                        <strong>{{ count($contents->posts->all()) }}</strong> Posts
                    @endif
                </h5>
                <h5>
                    <span class="glyphicon glyphicon-th-large"></span>
                    @if(count($contents->pages->all()) < 2)
                        <strong>{{ count($contents->pages->all()) }}</strong> Page
                    @else
                        <strong>{{ count($contents->pages->all()) }}</strong> Pages
                    @endif
                </h5>
                <h5>
                    <span class="glyphicon glyphicon-tags"></span>
                    @if(count($contents->tags->all()) < 2)
                        <strong>{{ count($contents->tags->all()) }}</strong> Tag
                    @else
                        <strong>{{ count($contents->tags->all()) }}</strong> Tags
                    @endif
                </h5>
                <h5>
                    <span class="glyphicon glyphicon-tasks"></span>
                    @if(count($contents->categories->all()) < 2)
                        <strong>{{ count($contents->categories->all()) }}</strong> Category
                    @else
                        <strong>{{ count($contents->categories->all()) }}</strong> Categories
                    @endif
                </h5>
                <h5>
                    <span class="glyphicon glyphicon-comment"></span>
                    @if(count($contents->comments->all()) < 2)
                        <strong>{{ count($contents->comments->all()) }}</strong> Comment
                    @else
                        <strong>{{ count($contents->comments->all()) }}</strong> Comments
                    @endif
                </h5>
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
    .parent-layout
    {
        margin: 0 0 40px;
    }

    .child-layout
    {
        padding: 10px 20px 10px;
    }
</style>
@endsection
