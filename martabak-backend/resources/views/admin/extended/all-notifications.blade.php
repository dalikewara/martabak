@if($search != '' AND !empty($search))
    <p class="green sort robot text-center underline pointer" value="clearsearch">Clear search</p>
@endif
@if(count($contents) != 0)
    <?php $a = 0; ?>
    @foreach($contents as $content)
        @if($content->status == 1)
            <div class="auto notification-layout bg-smoke read">
        @else
            <div class="pointer auto notification-layout bg-white notread click" value="{{ $a }}-notification" title="Mark as read">
        @endif
                @if($content->status == 1)
                    <span>
                        <input type="checkbox" class="content-checkbox input checkbox-all pointer" name="{{ md5('page') }}-{{ md5($content->id) }}" value="{{ md5($content->id) }}">
                    </span>
                @endif
                @if($content->type == 1)
                    @if($content->meta_2 != 0)
                        <span class="notification-content">
                            <strong><a class="{{ $themeColor }}" href="{{ $content->commentator->website }}">{{ $content->commentator->fullname }}</a></strong> reply <strong><a class="{{ $themeColor }}" href="{{ $content->reply->website }}">{{ $content->reply->fullname }}</a></strong>'s comment on your post which has title <strong><a class="{{ $themeColor }}" href="{{ $route->post_route }}/{{ $content->posts->slug }}">"My First Post"</a></strong> at <strong class="{{ $themeColor }} underline">2016-12-12 12:00:00</strong>
                        </span>
                    @else
                        <span class="notification-content">
                            <strong><a class="{{ $themeColor }}" href="{{ $content->commentator->website }}">{{ $content->commentator->fullname }}</a></strong> leave a reply to your post which has title <strong><a class="{{ $themeColor }}" href="{{ $route->post_route }}/{{ $content->posts->slug }}">"My First Post"</a></strong> at <strong class="{{ $themeColor }} underline">2016-12-12 12:00:00</strong>
                        </span>
                    @endif
                @elseif($content->type == 2)
                    <span class="notification-content">
                        Your post which title <strong><a class="{{ $themeColor }}" href="{{ $route->post_route }}/{{ $content->posts->slug }}">"My First Post"</a></strong> has <strong>+1</strong> favourite at <strong class="{{ $themeColor }} underline">2016-12-12 12:00:00</strong> and has <strong>10 total favourites</strong> now.
                    </span>
                @endif
                @if($content->status == 1)
                    <span class="red right auto process-button remove-edit click glyphicon glyphicon-remove" value="{{ $a }}-remove"></span>
                    <div id="child-content-tasks-{{ $a }}" class="text-right">
                    </div>
                @endif
                <form id="form-remove-{{ $a }}" role="form">
                    {{ csrf_field() }}
                    <input type="hidden" name="{{ md5('notification') }}-{{ md5($content->id) }}" value="{{ md5($content->id) }}">
                    <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToRemove') }}">
                    <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('notification') }}">
                </form>
                <form id="form-status-{{ $a }}" role="form">
                    {{ csrf_field() }}
                    <input type="hidden" name="{{ md5('notification') }}-{{ md5($content->id) }}" value="{{ md5($content->id) }}">
                    <input type="hidden" name="{{ md5('process-option-status') }}" value="{{ md5('yesIWantToChangeStatus') }}">
                    <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('notification') }}">
                </form>
            </div>
        <?php $a++; ?>
    @endforeach
    <div class="content-process-all auto">
        <div class="auto">
            <h5 title="Remove all" class="process-button remove-all right click red" value="all-remove-all"><span class="glyphicon glyphicon-remove"></span>Clear all notifications</h5>
            <form id="form-remove-all-all" role="form">
                {!! csrf_field() !!}
                <input type="hidden" name="{{ md5('all') }}" value="{{ md5('yes') }}">
                <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToRemove') }}">
                <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('notification') }}">
            </form>
        </div>
        <div id="child-content-tasks-all-all" class="text-right">
        </div>
    </div>
@else
    <h1 class="smoke text-center roboto empty-content">No notifications found.</h1>
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
