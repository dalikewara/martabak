@if($search != '' AND !empty($search))
    <p class="green sort robot text-center underline pointer" value="clearsearch">Clear search</p>
@endif
@if(count($contents) != 0)
    <table id="table-content">
        <tr>
            <th id="check"><input id="checkbox-top" class="input click checkbox-all" type="checkbox" value="check-checkbox"></th>
            <th class="th-name">Name</th>
            <th class="th-description">Description</th>
            <th class="th-relation">Posts relation</th>
            <th class="th-task">Tasks</th>
        </tr>
        <?php $a = 1; ?>
        @foreach($contents as $content)
            @if($content->default != 1)
                <tr class="tr">
                    <td>
                        <input type="checkbox" class="content-checkbox input checkbox-all" name="{{ md5('category') }}-{{ md5($content->id) }}" value="{{ md5($content->id) }}">
                    </td>
                    <td><a class="{{ $themeColor }} category-title" href="{{ $route->category_route }}/{{ $content->category_slug }}">{{ $content->category_name }}</a></td>
                    <td>{{ $content->category_description }}</td>
                    <td>
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
                    </td>
                    <td>
                        <div class="text-center">
                          <small id="content-{{ $content->id }}" class="process-button quick-edit click" value="{{ $a }}-quickedit"><span class="glyphicon glyphicon-edit"></span></small>
                          <small class="process-button trash-edit click" value="{{ $a }}-trash"><span class="glyphicon glyphicon-trash orange"></span></small>
                          <small class="process-button remove-edit click" value="{{ $a }}-remove"><span class="glyphicon glyphicon-remove red"></span></small>
                        </div>
                        <div id="child-content-tasks-{{ $a }}" class="text-center">
                        </div>
                        <form></form>
                        <form id="form-trash-{{ $a }}" role="form">
                            {{ csrf_field() }}
                            <input type="hidden" name="{{ md5('category') }}-{{ md5($content->id) }}" value="{{ md5($content->id) }}">
                            <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToTrash') }}">
                            <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('category') }}">
                        </form>
                        <form id="form-remove-{{ $a }}" role="form">
                            {{ csrf_field() }}
                            <input type="hidden" name="{{ md5('category') }}-{{ md5($content->id) }}" value="{{ md5($content->id) }}">
                            <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToRemove') }}">
                            <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('category') }}">
                        </form>
                    </td>
                </tr>
                <tr></tr>
                <tr id="tr-edit-{{ $a }}" class="tr tr-edit none">
                    <td></td>
                    <td>
                        <form id="form-quick-edit-main-{{ $a }}" role="form">
                            {!! csrf_field() !!}
                            <span class="smoke">Name:</span>
                            <input class="form-control input-quick-edit" type="text" name="{{ md5('name') }}" value="{{ $content->category_name }}">
                            <span class="smoke">Slug:</span>
                            <input class="form-control input-quick-edit" type="text" name="{{ md5('slug') }}" value="{{ $content->category_slug }}">
                            <input type="hidden" name="{{ md5('category') }}-{{ md5($content->id) }}" value="{{ md5($content->id) }}">
                            <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToEdit') }}">
                            <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('category') }}">
                        </form>
                    </td>
                    <td>
                        <form id="form-description-{{ $a }}" role="form">
                            <textarea class="category-description form-control" name="{{ md5('description') }}" rows="4" cols="40" value="{{ $content->category_description }}">{{ $content->category_description }}</textarea>
                        </form>
                    </td>
                    <td>
                        <form id="form-post-{{ $a }}" role="form">
                            <div id="loading-post-{{ $a }}" class="loading-post text-center none">
                                <img src="/admin/assets/icons/loading.gif" />
                            </div>
                        </form>
                    </td>
                    <td class="text-center">
                      <span class="btn bg-{{ $themeColor }} btn-sm click" value="{{ $a }}-update">Update</span>
                      <br><br>
                      <span class="btn btn-no btn-sm click" value="{{ $a }}-cancel">Cancel</span>
                    </td>
                </tr>
            @endif
            <?php $a++; ?>
        @endforeach
        <tr>
            <th id="check"><input id="checkbox-top" class="input click checkbox-all" type="checkbox" value="check-checkbox"></th>
            <th class="th-name">Name</th>
            <th class="th-description">Description</th>
            <th class="th-relation">Posts relation</th>
            <th class="th-task">Tasks</th>
        </tr>
    </table>
    <div class="content-process-all text-right">
        <div class="auto">
            <h5 title="Remove all" class="process-button remove-all right click red" value="all-remove-all"><span class="glyphicon glyphicon-remove"></span>Remove all</h5>
            <h5 title="Trash all" class="process-button trash-all right click orange" value="all-trash-all"><span class="glyphicon glyphicon-trash"></span>Trash all</h5>
            <form id="form-remove-all-all" role="form">
                {!! csrf_field() !!}
                <input type="hidden" name="{{ md5('all') }}" value="{{ md5('yes') }}">
                <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToRemove') }}">
                <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('category') }}">
            </form>
            <form id="form-trash-all-all" role="form">
                {!! csrf_field() !!}
                <input type="hidden" name="{{ md5('all') }}" value="{{ md5('yes') }}">
                <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToTrash') }}">
                <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('category') }}">
            </form>
        </div>
        <div id="child-content-tasks-all-all">

        </div>
    </div>
@else
    <h1 class="smoke text-center roboto empty-content">No categories found.</h1>
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
