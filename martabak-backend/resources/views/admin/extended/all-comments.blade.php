@if($search != '' AND !empty($search))
    <p class="green sort robot text-center underline pointer" value="clearsearch">Clear search</p>
@endif
@if(count($contents) != 0)
    <table id="table-content">
        <tr class="tr-top">
            <th id="check"><input id="checkbox-top" class="input click checkbox-all" type="checkbox" value="check-checkbox"></th>
            <th class="th-commentator">Commentator</th>
            <th class="th-in-reply">In Reply To</th>
            <th class="th-content">Content</th>
            <th class="th-date">Date & Time</th>
            <th class="th-tasks">Tasks</th>
        </tr>
        <?php $a = 1; ?>
        @foreach($contents as $content)
            <tr class="tr">
                <td>
                    <input type="checkbox" class="content-checkbox input checkbox-all" name="{{ md5('comment') }}-{{ md5($content->id) }}" value="{{ md5($content->id) }}">
                </td>
                @if($content->commentator != 0)
                    @if($content->guests->website != '')
                        <td><a class="{{ $themeColor }}" href="{{ $content->guests->website }}">{{ $content->guests->fullname }}</a></td>
                    @else
                        <td>{{ $content->guests->fullname }}</td>
                    @endif
                @else
                    <td>Yourself</td>
                @endif
                <td>
                    <small>
                        @if($content->in_reply == 0)
                            Post "<a class="{{ $themeColor }}" href="{{ $route->post_route }}/{{ $content->posts->slug }}">{{ $content->posts->title }}</a>"
                        @else
                            @if($contents->where('id', $content->in_reply)->first()->user_id == 0)
                                @if($contents->where('id', $content->in_reply)->first()->guests->website != '')
                                    <a class="{{ $themeColor }}" href="{{ $contents->where('id', $content->in_reply)->first()->guests->website }}">{{ $contents->where('id', $content->in_reply)->first()->guests->fullname }}</a>'s comment on Post "<a class="{{ $themeColor }}" href="{{ $route->post_route }}/{{ $content->posts->slug }}">{{ $content->posts->title }}</a>"
                                @else
                                    {{ $contents->where('id', $content->in_reply)->first()->guests->fullname }}'s comment on Post "<a class="{{ $themeColor }}" href="{{ $route->post_route }}/{{ $content->posts->slug }}">{{ $content->posts->title }}</a>"
                                @endif
                            @else
                                Your comment on Post "<a class="{{ $themeColor }}" href="{{ $route->post_route }}/{{ $content->posts->slug }}">{{ $content->posts->title }}</a>"
                            @endif
                        @endif
                    </small>
                </td>
                <td>{{ $content->content }}</td>
                <td><small>{{ $content->created_at }}0000-00-00 00:00:00</small></td>
                <td>
                    <div class="text-center">
                        @if($content->status == 0)
                            <span class="process-button green click" value="{{ $a }}-comment-approve-green"><span class="glyphicon glyphicon-ok-sign"></span></span>
                        @elseif($content->status == 1)
                            <span class="process-button yellow click" value="{{ $a }}-comment-dontapprove-yellow"><span class="glyphicon glyphicon-remove-sign"></span></span>
                        @endif
                        @if($content->spam == 0)
                            <span class="process-button orange click" value="{{ $a }}-comment-spam-orange"><span class="glyphicon glyphicon-alert"></span></span>
                        @endif
                        @if($content->blacklist == 0)
                            <span class="process-button click" value="{{ $a }}-comment-blacklist-black"><span class="glyphicon glyphicon-ban-circle"></span></span>
                        @endif
                        <span class="process-button red click" value="{{ $a }}-remove"><span class="glyphicon glyphicon-remove"></span></span>
                    </div>
                    <div id="child-content-tasks-{{ $a }}">
                    </div>
                    <form id="form-remove-{{ $a }}" role="form">
                        {{ csrf_field() }}
                        <input type="hidden" name="{{ md5('comment') }}-{{ md5($content->id) }}" value="{{ md5($content->id) }}">
                        <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToRemove') }}">
                        <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('comment') }}">
                    </form>
                    <form id="form-approve-{{ $a }}" role="form">
                        {{ csrf_field() }}
                        <input type="hidden" name="{{ md5('comment') }}-{{ md5($content->id) }}" value="{{ md5($content->id) }}">
                        <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToChangeStatus') }}">
                        <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('comment') }}">
                        <input type="hidden" name="{{ md5('status') }}" value="{{ md5('approve') }}">
                    </form>
                    <form id="form-dontapprove-{{ $a }}" role="form">
                        {{ csrf_field() }}
                        <input type="hidden" name="{{ md5('comment') }}-{{ md5($content->id) }}" value="{{ md5($content->id) }}">
                        <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToChangeStatus') }}">
                        <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('comment') }}">
                        <input type="hidden" name="{{ md5('status') }}" value="{{ md5('dontapprove') }}">
                    </form>
                    <form id="form-spam-{{ $a }}" role="form">
                        {{ csrf_field() }}
                        <input type="hidden" name="{{ md5('comment') }}-{{ md5($content->id) }}" value="{{ md5($content->id) }}">
                        <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToChangeStatus') }}">
                        <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('comment') }}">
                        <input type="hidden" name="{{ md5('status') }}" value="{{ md5('spam') }}">
                    </form>
                    <form id="form-blacklist-{{ $a }}" role="form">
                        {{ csrf_field() }}
                        <input type="hidden" name="{{ md5('comment') }}-{{ md5($content->id) }}" value="{{ md5($content->id) }}">
                        <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToChangeStatus') }}">
                        <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('comment') }}">
                        <input type="hidden" name="{{ md5('status') }}" value="{{ md5('blacklist') }}">
                    </form>
                </td>
            </tr>
            <?php $a++; ?>
        @endforeach
        <tr class="tr-bottom">
            <th id="check"><input id="checkbox-top" class="input click checkbox-all" type="checkbox" value="check-checkbox"></th>
            <th class="th-commentator">Commentator</th>
            <th class="th-in-reply">In Reply To</th>
            <th class="th-content">Content</th>
            <th class="th-date">Date & Time</th>
            <th class="th-tasks">Tasks</th>
        </tr>
    </table>
    <div class="content-process-all">
        <div class="auto">
            <h5 title="Remove all" class="process-button remove-all right click red" value="all-remove-all"><span class="glyphicon glyphicon-remove"></span>Remove all comments</h5>
            <form id="form-remove-all-all" role="form">
                {!! csrf_field() !!}
                <input type="hidden" name="{{ md5('all') }}" value="{{ md5('yes') }}">
                <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToRemove') }}">
                <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('comment') }}">
            </form>
        </div>
        <div id="child-content-tasks-all-all" class="text-right">
        </div>
    </div>
@else
    <h1 class="smoke text-center roboto empty-content">No comments found.</h1>
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
