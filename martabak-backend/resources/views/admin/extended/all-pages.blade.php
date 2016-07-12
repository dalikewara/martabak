@if($search != '' AND !empty($search))
    <p class="smoke text-right">Searching "{{ $search }}" on <i>{{ $status }}...</i></p>
    <p class="green sort robot text-center underline pointer" value="clearsearch">Clear search</p>
@endif
<input id="checkbox-top" class="input click checkbox-all auto" type="checkbox" value="check-checkbox"> Select all
@if(count($contents) != 0)
    <?php $a = 0; ?>
    @foreach(array_chunk($contents->all(), 5) as $row)
        <div class="row">
            @foreach($row as $content)
                @if(preg_match('/^[a-e]/i', $content->title))
                    <div class="col-sm-2 page-layout bg-blue white transition">
                        <div class="auto right">
                            <small class="edit"><a href="process/full/edit/page/{{ $content->slug }}"><span class="process-button glyphicon glyphicon-edit white"></span></a></small>
                            <small id="content-{{ $content->id }}" class="auto process-button quick-edit click" value="{{ $a }}-quickedit"><span class="glyphicon glyphicon-edit quick"></span></small>
                            <small class="auto process-button trash-edit click" value="{{ $a }}-trash"><span class="glyphicon glyphicon-trash orange"></span></small>
                            <small class="auto process-button remove-edit click" value="{{ $a }}-remove"><span class="glyphicon glyphicon-remove white"></span></small>
                        </div>
                @elseif(preg_match('/^[f-j]/i', $content->title))
                    <div class="col-sm-2 page-layout bg-green white transition">
                        <div class="auto right">
                            <small class="edit"><a href="process/full/edit/page/{{ $content->slug }}"><span class="process-button glyphicon glyphicon-edit white"></span></a></small>
                            <small id="content-{{ $content->id }}" class="auto process-button quick-edit click" value="{{ $a }}-quickedit"><span class="glyphicon glyphicon-edit quick"></span></small>
                            <small class="auto process-button trash-edit click" value="{{ $a }}-trash"><span class="glyphicon glyphicon-trash orange"></span></small>
                            <small class="auto process-button remove-edit click" value="{{ $a }}-remove"><span class="glyphicon glyphicon-remove white"></span></small>
                        </div>
                @elseif(preg_match('/^[k-o]/i', $content->title))
                    <div class="col-sm-2 page-layout bg-orange transition">
                        <div class="auto right">
                            <small class="edit"><a href="process/full/edit/page/{{ $content->slug }}"><span class="process-button glyphicon glyphicon-edit black"></span></a></small>
                            <small id="content-{{ $content->id }}" class="auto process-button quick-edit click" value="{{ $a }}-quickedit"><span class="glyphicon glyphicon-edit quick"></span></small>
                            <small class="auto process-button trash-edit click" value="{{ $a }}-trash"><span class="glyphicon glyphicon-trash black"></span></small>
                            <small class="auto process-button remove-edit click" value="{{ $a }}-remove"><span class="glyphicon glyphicon-remove red"></span></small>
                        </div>
                @elseif(preg_match('/^[p-t]/i', $content->title))
                    <div class="col-sm-2 page-layout bg-red white transition">
                        <div class="auto right">
                            <small class="edit"><a href="process/full/edit/page/{{ $content->slug }}"><span class="process-button glyphicon glyphicon-edit white"></span></a></small>
                            <small id="content-{{ $content->id }}" class="auto process-button quick-edit click" value="{{ $a }}-quickedit"><span class="glyphicon glyphicon-edit quick"></span></small>
                            <small class="auto process-button trash-edit click" value="{{ $a }}-trash"><span class="glyphicon glyphicon-trash orange"></span></small>
                            <small class="auto process-button remove-edit click" value="{{ $a }}-remove"><span class="glyphicon glyphicon-remove white"></span></small>
                        </div>
                @else(preg_match('/^[u-z]/i', $content->title))
                    <div class="col-sm-2 page-layout bg-yellow transition">
                        <div class="auto right">
                            <small class="edit"><a href="process/full/edit/page/{{ $content->slug }}"><span class="process-button glyphicon glyphicon-edit black"></span></a></small>
                            <small id="content-{{ $content->id }}" class="auto process-button quick-edit click" value="{{ $a }}-quickedit"><span class="glyphicon glyphicon-edit quick"></span></small>
                            <small class="auto process-button trash-edit click" value="{{ $a }}-trash"><span class="glyphicon glyphicon-trash orange"></span></small>
                            <small class="auto process-button remove-edit click" value="{{ $a }}-remove"><span class="glyphicon glyphicon-remove red"></span></small>
                        </div>
                @endif
                        <div>
                            <span><input type="checkbox" class="content-checkbox input checkbox-all pointer" name="{{ md5('page') }}-{{ md5($content->id) }}" value="{{ md5($content->id) }}"></span>
                        </div>
                        <div id="child-content-tasks-{{ $a }}">

                        </div>
                        <div class="text-center roboto">
                            <h1 class="tumb-page disable-pointer-events">{{ substr($content->title, 0 ,1) }}</h1>
                        </div>
                        <div class="page-option auto">
                            <div id="tr-edit-{{ $a }}" class="tr tr-edit tr-edit-page none">
                                <form id="form-quick-edit-main-{{ $a }}" role="form">
                                    {!! csrf_field() !!}
                                    <span class="smoke"><small>Name:</small></span>
                                    <input class="small-text-page form-control input-quick-edit" type="text" name="{{ md5('name') }}" value="{{ $content->title }}">
                                    <span class="smoke"><small>Slug:</small></span>
                                    <input class="small-text-page form-control input-quick-edit" type="text" name="{{ md5('slug') }}" value="{{ $content->slug }}">
                                    <input type="hidden" name="{{ md5('page') }}-{{ md5($content->id) }}" value="{{ md5($content->id) }}">
                                    <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToEdit') }}">
                                    <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('page') }}">
                                </form>
                                <div class="edit-button-page text-right">
                                    <small class="btn bg-{{ $themeColor }} btn-sm click" value="{{ $a }}-update">Update</small>
                                    <small class="btn btn-no btn-sm click" value="{{ $a }}-cancel">Cancel</small>
                                </div>
                            </div>
                        </div>
                        <div>
                            <small class="page-title">{{ $content->title }}</small>
                            <a href="{{ $route->page_route }}/{{ $content->slug }}"><span class="glyphicon glyphicon-eye-open white"></span></a>
                            <br>
                            <small class="page-desc">by {{ $content->users->fullname }} at {{ $content->created_at }}</small>
                        </div>
                        <form id="form-trash-{{ $a }}" role="form">
                            {{ csrf_field() }}
                            <input type="hidden" name="{{ md5('page') }}-{{ md5($content->id) }}" value="{{ md5($content->id) }}">
                            <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToTrash') }}">
                            <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('page') }}">
                        </form>
                        <form id="form-remove-{{ $a }}" role="form">
                            {{ csrf_field() }}
                            <input type="hidden" name="{{ md5('page') }}-{{ md5($content->id) }}" value="{{ md5($content->id) }}">
                            <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToRemove') }}">
                            <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('page') }}">
                        </form>
                </div>
                <?php $a++; ?>
            @endforeach
        </div>
    @endforeach
    <div class="content-process-all">
        <div class="auto">
            <h5 title="Remove all" class="process-button remove-all right click red" value="all-remove-all"><span class="glyphicon glyphicon-remove"></span>Remove all</h5>
            <h5 title="Trash all" class="process-button trash-all right click orange" value="all-trash-all"><span class="glyphicon glyphicon-trash"></span>Trash all</h5>
            <form id="form-remove-all-all" role="form">
                {!! csrf_field() !!}
                <input type="hidden" name="{{ md5('all') }}" value="{{ md5('yes') }}">
                <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToRemove') }}">
                <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('page') }}">
            </form>
            <form id="form-trash-all-all" role="form">
                {!! csrf_field() !!}
                <input type="hidden" name="{{ md5('all') }}" value="{{ md5('yes') }}">
                <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToTrash') }}">
                <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('page') }}">
            </form>
        </div>
        <div id="child-content-tasks-all-all" class="text-right">

        </div>
    </div>
@else
    <h1 class="smoke text-center roboto empty-content">No pages found.</h1>
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
