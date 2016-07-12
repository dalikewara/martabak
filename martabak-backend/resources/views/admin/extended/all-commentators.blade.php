@if($search != '' AND !empty($search))
    <p class="green sort robot text-center underline pointer" value="clearsearch">Clear search</p>
@endif
@if(count($contents) != 0)
    <?php $a = 0; ?>
    @foreach($contents as $content)
        <div class="commentators-layout auto">
            <input type="checkbox" class="left content-checkbox input checkbox-all pointer" name="{{ md5('page') }}-{{ md5($content->id) }}" value="{{ md5($content->id) }}">
            @if($content->website != '')
                <div class="left auto">
                    <img class="commentators-pic" src="/admin/assets/icons/page.png" />
                </div>
                <div class="commentators-inner-content left auto">
                    <span><a href="{{ $content->website }}"><strong>{{ $content->fullname }}</strong></a></span>
                    <br>
                    <span>E-mail: {{ $content->email }}</span>
                    <br>
                    @if(count($content->comments->where('commentator', $content->id)->get()) > 1)
                        <span>Leave about {{ count($content->comments->where('commentator', $content->id)->get()) }} comments</span>
                    @else
                        <span>Leave about {{ count($content->comments->where('commentator', $content->id)->get()) }} comment</span>
                    @endif
                </div>
                <div class="right">
                    <span class="red right auto process-button remove-edit click glyphicon glyphicon-remove" value="{{ $a }}-remove"></span>
                </div>
            @else
                <div class="left auto">
                    <img class="commentators-pic" src="/admin/assets/icons/page.png" />
                </div>
                <div class="commentators-inner-content left auto">
                    <span><strong>{{ $content->fullname }}</strong></span>
                    <br>
                    <span>E-mail: {{ $content->email }}</span>
                    <br>
                    @if(count($content->comments->where('commentator', $content->id)->get()) > 1)
                        <span>Leave about {{ count($content->comments->where('commentator', $content->id)->get()) }} comments</span>
                    @else
                        <span>Leave about {{ count($content->comments->where('commentator', $content->id)->get()) }} comment</span>
                    @endif
                </div>
                <div class="right">
                    <span class="red right auto process-button remove-edit click glyphicon glyphicon-remove" value="{{ $a }}-remove"></span>
                </div>
            @endif
            <br>
            <div id="child-content-tasks-{{ $a }}" class="right">

            </div>
        </div>
        <form id="form-remove-{{ $a }}" role="form">
            {{ csrf_field() }}
            <input type="hidden" name="{{ md5('commentator') }}-{{ md5($content->id) }}" value="{{ md5($content->id) }}">
            <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToRemove') }}">
            <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('commentator') }}">
        </form>
        <?php $a++; ?>
    @endforeach
    <div class="content-process-all auto">
        <div class="auto">
            <h5 title="Remove all" class="process-button remove-all right click red" value="all-remove-all"><span class="glyphicon glyphicon-remove"></span>Clear all commentators</h5>
            <form id="form-remove-all-all" role="form">
                {!! csrf_field() !!}
                <input type="hidden" name="{{ md5('all') }}" value="{{ md5('yes') }}">
                <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToRemove') }}">
                <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('commentator') }}">
            </form>
        </div>
        <div id="child-content-tasks-all-all" class="text-right">
        </div>
    </div>
@else
    <h1 class="smoke text-center roboto empty-content">No commentators found.</h1>
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
