@if($search != '' AND !empty($search))
    <p class="green sort robot text-center underline pointer" value="clearsearch">Clear search</p>
@endif
<input id="checkbox-top" class="input click checkbox-all auto" type="checkbox" value="check-checkbox"> Select all
@if(count($contents) != 0)
    <div class="tag-main-content auto">
        <?php $a = 0; ?>
        @foreach(array_chunk($contents->all(), 5) as $row)
            <div class="row row-tag">
                @foreach($row as $content)
                    <div class="tag-content transition shadow col-sm-2">
                        <div class="auto right">
                            <small id="content-{{ $content->id }}" class="auto process-button quick-edit click" value="{{ $a }}-quickedit"><span class="glyphicon glyphicon-edit"></span></small>
                            <small class="auto process-button trash-edit click" value="{{ $a }}-trash"><span class="glyphicon glyphicon-trash orange"></span></small>
                            <small class="auto process-button remove-edit click" value="{{ $a }}-remove"><span class="glyphicon glyphicon-remove red"></span></small>
                        </div>
                        <span><input type="checkbox" class="content-checkbox input checkbox-all" name="{{ md5('tag') }}-{{ md5($content->id) }}" value="{{ md5($content->id) }}"></span>
                        <br>
                        <span class="tag-title right auto"><a class="{{ $themeColor }}" href="{{ $route->tag_route }}/{{ $content->tag_slug }}">{{ $content->tag_name }}</a></span>
                        <br>
                        <div id="child-content-tasks-{{ $a }}" class="text-center">
                        </div>
                        <div id="tr-edit-{{ $a }}" class="tr-edit none">
                            <form id="form-quick-edit-main-{{ $a }}" role="form">
                                {!! csrf_field() !!}
                                <span class="smoke"><small>Name:</small></span>
                                <input class="small-text-tag form-control input-quick-edit" type="text" name="{{ md5('name') }}" value="{{ $content->tag_name }}">
                                <span class="smoke"><small>Slug:</small></span>
                                <input class="small-text-tag form-control input-quick-edit" type="text" name="{{ md5('slug') }}" value="{{ $content->tag_slug }}">
                                <input type="hidden" name="{{ md5('tag') }}-{{ md5($content->id) }}" value="{{ md5($content->id) }}">
                                <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToEdit') }}">
                                <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('tag') }}">
                            </form>
                            <br>
                            <form id="form-post-{{ $a }}" role="form">
                                <div id="loading-post-{{ $a }}" class="loading-post text-center none">
                                    <img src="/admin/assets/icons/loading.gif" />
                                </div>
                            </form>
                            <br>
                            <small class="btn bg-{{ $themeColor }} btn-sm click" value="{{ $a }}-update">Update</small>
                            <small class="btn btn-no btn-sm click" value="{{ $a }}-cancel">Cancel</small>
                        </div>
                        <div class="separator-tag auto"></div>
                        <form></form>
                        <form id="form-trash-{{ $a }}" role="form">
                            {{ csrf_field() }}
                            <input type="hidden" name="{{ md5('tag') }}-{{ md5($content->id) }}" value="{{ md5($content->id) }}">
                            <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToTrash') }}">
                            <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('tag') }}">
                        </form>
                        <form id="form-remove-{{ $a }}" role="form">
                            {{ csrf_field() }}
                            <input type="hidden" name="{{ md5('tag') }}-{{ md5($content->id) }}" value="{{ md5($content->id) }}">
                            <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToRemove') }}">
                            <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('tag') }}">
                        </form>
                        <?php $breakContents = 1; ?>
                        @if(count($content->posts->all()) != 0)
                            @foreach($content->posts as $post)
                                @if($breakContents > 4)
                                    <small class="smoke">and {{ count($content->posts->all()) - 4 }} more...</small>
                                    <?php break; ?>
                                @endif
                                <small class="smooth-black">{{ $post->title }}, </small>
                                <?php $breakContents++; ?>
                            @endforeach
                        @else
                            <small class="smoke text-center">No posts found</small>
                        @endif
                        <?php $a++; ?>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
    <div class="content-process-all text-right">
        <div class="auto">
            <h5 title="Remove all" class="process-button remove-all right click red" value="all-remove-all"><span class="glyphicon glyphicon-remove"></span>Remove all</h5>
            <h5 title="Trash all" class="process-button trash-all right click orange" value="all-trash-all"><span class="glyphicon glyphicon-trash"></span>Trash all</h5>
            <form id="form-remove-all-all" role="form">
                {!! csrf_field() !!}
                <input type="hidden" name="{{ md5('all') }}" value="{{ md5('yes') }}">
                <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToRemove') }}">
                <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('tag') }}">
            </form>
            <form id="form-trash-all-all" role="form">
                {!! csrf_field() !!}
                <input type="hidden" name="{{ md5('all') }}" value="{{ md5('yes') }}">
                <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToTrash') }}">
                <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('tag') }}">
            </form>
        </div>
        <div id="child-content-tasks-all-all">
        </div>
    </div>
@else
    <h1 class="smoke text-center roboto empty-content">No tags found.</h1>
@endif
<div class="box-pagination">
    <ul class="menu-inline menu-pagination">
        {!! $pagePrev !!}
        @foreach($pageLists as $pageList)
            {!! $pageList !!}
        @endforeach
        {!! $pageMore !!}
        {!! $pageNext !!}
    </ul>
</div>
