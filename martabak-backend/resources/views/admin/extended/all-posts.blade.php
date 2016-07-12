@if($search != '' AND !empty($search))
    <p class="smoke text-right">Searching "{{ $search }}" on <i>{{ $status }}...</i></p>
    <p class="green sort robot text-center underline pointer" value="clearsearch">Clear search</p>
@endif
@if(count($contents) != 0)
    <table>
        <tr class="table-head-top">
            <th id="check"><input id="checkbox-top" class="input click checkbox-all" type="checkbox" value="check-checkbox"></th>
            <th id="author">Author</th>
            <th id="title">Title</th>
            <th id="tag">Tags</th>
            <th id="category">Categories</th>
            <th id="date">Date & Time</th>
            <th id="comment">Comments</th>
        </tr>
        <div id="tr-placement">
            <?php $a = 1; ?>
            @foreach($contents as $content)
                <tr class="tr">
                    <td>
                        <input type="checkbox" class="content-checkbox input checkbox-all" name="{{ md5('post') }}-{{ md5($content->id) }}" value="{{ md5($content->id) }}">
                    </td>
                    <td>{{ $content->user->fullname }}</td>
                    <td>
                        <span class='post-title'><a class="{{ $themeColor }}" href="{{ $route->post_route }}/{{ $content->slug }}">{{ $content->title }}<a/></span>
                        <br>
                        <small class="edit" value="{{ $a }}"><a href="process/full/edit/post/{{ $content->slug }}"><span class="process-button glyphicon glyphicon-edit green"></span></a></small> /
                        <small id="content-{{ $content->id }}" class="process-button quick-edit click" value="{{ $a }}-quickedit"><span class="glyphicon glyphicon-edit"></span> Quick edit</small> /
                        <small class="process-button trash-edit click" value="{{ $a }}-trash"><span class="glyphicon glyphicon-trash orange"></span></small> /
                        <small class="process-button remove-edit click" value="{{ $a }}-remove"><span class="glyphicon glyphicon-remove red"></span></small>
                        <div id="child-content-tasks-{{ $a }}">
                        </div>
                        <form></form>
                        <form id="form-trash-{{ $a }}" role="form">
                            {{ csrf_field() }}
                            <input type="hidden" name="{{ md5('post') }}-{{ md5($content->id) }}" value="{{ md5($content->id) }}">
                            <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToTrash') }}">
                            <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('post') }}">
                        </form>
                        <form id="form-remove-{{ $a }}" role="form">
                            {{ csrf_field() }}
                            <input type="hidden" name="{{ md5('post') }}-{{ md5($content->id) }}" value="{{ md5($content->id) }}">
                            <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToRemove') }}">
                            <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('post') }}">
                        </form>
                    </td>
                    <td>
                        <?php $breakContents = 1; ?>
                        @if(count($content->tags->all()) != 0)
                            @foreach($content->tags as $tag)
                                @if($breakContents > 4)
                                    <span class="smooth-black">and {{ count($content->tags->all()) - 4 }} more...</span>
                                    <?php break; ?>
                                @endif
                                {{ $tag->tag_name }},
                                <?php $breakContents++; ?>
                            @endforeach
                        @else
                            <span class="smooth-black text-center">No tags found</span>
                        @endif
                    </td>
                    <td>
                        @foreach($content->categories as $category)
                            {{ $category->category_name }},
                        @endforeach
                    </td>
                    <td><small>{{ $content->created_at }}</small></td>
                    <td>
                        @if(count($content->comments) != 0)
                            {{ count($content->comments) }}
                        @else
                            <span class="smooth-black text-center">0</span>
                        @endif
                    </td>
                </tr>
                <tr></tr>
                <tr id="tr-edit-{{ $a }}" class="tr tr-edit none">
                    <td></td>
                    <td></td>
                    <td>
                        <form id="form-quick-edit-main-{{ $a }}" role="form">
                            {!! csrf_field() !!}
                            <span class="smoke">Title:</span>
                            <input class="form-control input-quick-edit" type="text" name="{{ md5('name') }}" value="{{ $content->title }}">
                            <span class="smoke">Slug:</span>
                            <input class="form-control input-quick-edit" type="text" name="{{ md5('slug') }}" value="{{ $content->slug }}">
                            <input type="hidden" name="{{ md5('post') }}-{{ md5($content->id) }}" value="{{ md5($content->id) }}">
                            <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToEdit') }}">
                            <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('post') }}">
                        </form>
                    </td>
                    <td>
                        <form id="form-tag-{{ $a }}" role="form">
                            <div id="loading-tag-{{ $a }}" class="loading-tag text-center none">
                                <img src="/admin/assets/icons/loading.gif" />
                            </div>
                        </form>
                    </td>
                    <td>
                        <form id="form-category-{{ $a }}" role="form">
                            <div id="loading-category-{{ $a }}" class="loading-category text-center none">
                                <img src="/admin/assets/icons/loading.gif" />
                            </div>
                        </form>
                    </td>
                    <td>
                        <form id="form-date-{{ $a }}" role="form">
                            <input class="form-control input-quick-edit" type="text" name="{{ md5('time') }}" value="{{ $content->created_at }}">
                            <small class="smoke">Format: Y-m-d H:i</small>
                        </form>
                        <br>
                        <span class="btn btn-sm click bg-{{ $themeColor }}" value="{{ $a }}-update">Update</span>
                        <span class="btn btn-no btn-sm click" value="{{ $a }}-cancel">Cancel</span>
                    </td>
                    <td></td>
                </tr>
                <?php $a++; ?>
            @endforeach
        </div>
        <tr class="table-head-bottom">
            <th id="check"><input id="checkbox-bottom" class="input click checkbox-all" type="checkbox" value="check-checkbox"></th>
            <th id="author">Author</th>
            <th id="title">Title</th>
            <th id="tag">Tags</th>
            <th id="category">Categories</th>
            <th id="date">Date & Time</th>
            <th id="comment">Comments</th>
        </tr>
    </table>
    <div class="content-process-all text-right">
        <div class="auto">
            <h5 title="Remove all" class="process-button remove-all right click red" value="all-remove-all"><span class="glyphicon glyphicon-remove"></span>Remove all</h5>
            <h5 title="Trash all" class="process-button trash-all right click orange" value="all-trash-all"><span class="glyphicon glyphicon-trash"></span>Trash all</h5>
            <br><br>
            <div id="child-content-tasks-all-all">
            </div>
            <form id="form-remove-all-all" role="form">
                {!! csrf_field() !!}
                <input type="hidden" name="{{ md5('all') }}" value="{{ md5('yes') }}">
                <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToRemove') }}">
                <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('post') }}">
            </form>
            <form id="form-trash-all-all" role="form">
                {!! csrf_field() !!}
                <input type="hidden" name="{{ md5('all') }}" value="{{ md5('yes') }}">
                <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToTrash') }}">
                <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('post') }}">
            </form>
        </div>
    </div>
@else
    <h1 class="smoke text-center roboto empty-content">No posts found.</h1>
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
