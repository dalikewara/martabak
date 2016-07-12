<div id="uploading-progress-main" class="row bg-white none" style="margin:0">
    <div id="uploading-progress-layout">
    </div>
</div>
<div id="main-media-layout">
    <div id="content-media-layout">
        @if(count($contents) != 0)
            <?php $a = 0; ?>
            @foreach(array_chunk($contents->all(), 4) as $row)
                <div class="row" style="margin:0">
                    @foreach($row as $content)
                        <div class="col-sm-3 media-inner-layout">
                            <div class="transition bg-white pointer media-img-layout" value="ok">
                                <div class="auto text-right">
                                    <small class="auto process-button remove-edit click" value="{{ $a }}-remove-profile"><span class="glyphicon glyphicon-remove red"></span></small>
                                    <div id="child-content-tasks-{{ $a }}" class="text-center">
                                    </div>
                                    <form id="form-remove-{{ $a }}" role="form">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="{{ md5('media') }}-{{ md5($content->id) }}" value="{{ md5($content->id) }}">
                                        <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToRemove') }}">
                                        <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('media') }}">
                                        <input type="hidden" name="{{ md5('media-type') }}" value="{{ md5('picture') }}">
                                        <input type="hidden" name="{{ md5('file-name') }}" value="{{ $content->file_name }}">
                                    </form>
                                </div>
                                <img class="media-img-thumbnail media-click" src="{{ $dir->url('pictures') }}/{{ $content->file_name }}" value="select-{{ $themeColor }}-choose:[YourProfilePicture];-{{ $content->file_name }}" />
                            </div>
                        </div>
                        <?php $a++; ?>
                    @endforeach
                </div>
            @endforeach
        @else
            <h1 class="smoke text-center roboto empty-content">No profile pictures found.</h1>
        @endif
    </div>
</div>
