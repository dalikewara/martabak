@if($search != '' AND !empty($search))
    <p class="green sort robot text-center underline pointer" value="clearsearch">Clear search</p>
@endif
@if(count($contents) != 0)
    <div class="theme-main-content auto">
        <?php $a = 0; ?>
        <input id="checkbox-top" class="input click checkbox-all auto" type="checkbox" value="check-checkbox"> Select all
        <br>
        <br>
        @foreach(array_chunk($contents->all(), 5) as $row)
            <div class="row row-theme">
                @foreach($row as $content)
                    @if($content->theme_status == 0)
                        <div class="transition theme-content col-sm-2 bg-smoke">
                            <input type="checkbox" class="content-checkbox input checkbox-all" name="{{ md5('tag') }}-{{ md5($content->id) }}" value="{{ md5($content->id) }}">
                            <div class="text-center">
                                <img class="theme-img" src="/admin/assets/icons/setting.png" alt="" />
                            </div>
                            <br>
                            <div class="text-center">
                                <small class="btn bg-{{ $themeColor }} btn-sm click" value="{{ $a }}-active">Activate</small>
                                <small class="btn btn-danger btn-sm click" value="{{ $a }}-remove">Remove</small>
                            </div>
                            <div id="child-content-tasks-{{ $a }}" class="text-center">
                            </div>
                            <br>
                            <div class="text-center">
                                <span class="theme-name-text">{{ $content->title }}</span> <small class="smoke">by {{ $content->author }}</small>
                            </div>
                        </div>
                    @endif
                    <form id="form-remove-{{ $a }}" role="form">
                        {{ csrf_field() }}
                        <input type="hidden" name="{{ md5('theme') }}-{{ md5($content->id) }}" value="{{ md5($content->id) }}">
                        <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToRemove') }}">
                        <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('theme') }}">
                    </form>
                    <form id="form-active-{{ $a }}" role="form">
                        {{ csrf_field() }}
                        <input type="hidden" name="{{ md5('theme') }}-{{ md5($content->id) }}" value="{{ md5($content->id) }}">
                        <input type="hidden" name="{{ md5('process-option-status') }}" value="{{ md5('yesIWantToChangeStatus') }}">
                        <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('theme') }}">
                        <input type="hidden" name="{{ md5('active-status') }}" value="{{ md5('active') }}">
                    </form>
                    <?php $a++; ?>
                @endforeach
            </div>
        @endforeach
    </div>
    <div class="content-process-all auto">
        <div class="auto">
            <h5 title="Remove all" class="process-button remove-all right click red" value="all-remove-all"><span class="glyphicon glyphicon-remove"></span>Remove all</h5>
            <form id="form-remove-all-all" role="form">
                {!! csrf_field() !!}
                <input type="hidden" name="{{ md5('all') }}" value="{{ md5('yes') }}">
                <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToRemove') }}">
                <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('theme') }}">
            </form>
        </div>
        <div id="child-content-tasks-all-all" class="text-right">
        </div>
    </div>
@else
    <h1 class="smoke text-center roboto empty-content">No themes found.</h1>
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
