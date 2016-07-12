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
                                    <small class="auto process-button remove-edit click" value="{{ $a }}-remove-media"><span class="glyphicon glyphicon-remove red"></span></small>
                                    <div id="child-content-tasks-media-{{ $a }}" class="text-center">
                                    </div>
                                    <form id="form-remove-media-{{ $a }}" role="form">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="{{ md5('media') }}-{{ md5($content->id) }}" value="{{ md5($content->id) }}">
                                        <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToRemove') }}">
                                        <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('media') }}">
                                        <input type="hidden" name="{{ md5('media-type') }}" value="{{ md5('picture') }}">
                                        <input type="hidden" name="{{ md5('file-name') }}" value="{{ $content->file_name }}">
                                    </form>
                                </div>
                                <div class="div-media-img">
                                    <img class="media-img-thumbnail media-click" src="{{ $dir->url('pictures') }}/{{ $content->file_name }}" value="detail-{{ $themeColor }}-choose:[YourProfilePicture];-{{ $content->file_name }}" />
                                    <input class="img-meta-index" type="hidden" name="{{ md5('media') }}-{{ md5($content->id) }}" value="{{ md5($content->id) }}">
                                    <input class="img-meta-content" type="hidden" value="image">
                                    <input class="img-meta-type" type="hidden" value="{{ $content->file_type }}">
                                    <input class="img-meta-size" type="hidden" value="{{ $content->size }}">
                                    <input class="img-meta-created" type="hidden" value="{{ $content->created_at }}">
                                    <input class="img-meta-filename" type="hidden" value="{{ $content->file_name }}">
                                    <input class="img-meta-title" type="hidden" value="{{ $content->meta_1 }}">
                                    <input class="img-meta-caption" type="hidden" value="{{ $content->meta_2 }}">
                                    <input class="img-meta-alt" type="hidden" value="{{ $content->meta_3 }}">
                                    <input class="img-meta-desc" type="hidden" value="{{ $content->meta_4 }}">
                                </div>
                            </div>
                        </div>
                        <?php $a++; ?>
                    @endforeach
                </div>
            @endforeach
        @else
            <h1 class="smoke text-center roboto empty-content">No pictures found.</h1>
        @endif
    </div>
</div>
