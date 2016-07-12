<div class="dark-div none">
</div>
<div id="media-menu" class="media-menu none">
    <div class="media-menu-inner bg-white shadow">
        <div class="media-header">
            <div class="media-menu-title text-center bg-white">
                <h3 id="h3-media-menu-title" value="Pictures">Pictures</h3>
                <hr>
            </div>
            <div class="media-menu-panel-top bg-white">
                <form id="form-upload-media-content" role="form" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <input id="select-media-content" class="hide media-upload" name="{{ md5('name') }}" type="file" multiple/>
                    <label id="upload-media-content" class="pointer media-label" for="select-media-content"><span class="glyphicon glyphicon-plus"></span> Upload new</label>
                    <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToUpload') }}">
                    <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('picture') }}">
                    <input id="input-value-picture" type="hidden" value="{{ md5('picture') }}">
                </form>
                <hr>
            </div>
        </div>
        <div class="auto media-menu-content bg-smoke">
            <div id="load-media-content">
                <div id="loading-media-content" class="loading text-center">
                    <img src="/martabak-frontend/admin/assets/icons/loading.gif" />
                    <p>Loading media...</p>
                </div>
            </div>
            <div id="media-detail-menu" class="none">
                <form id="form-media-update" role="form">
                    {!! csrf_field() !!}
                    <div class="col-sm-5">
                        <div>
                            <img id="img-detail" width="100%" />
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label>Url: </label><span>{{ $route->media_route }}/</span><span id="media-meta-content"></span>
                        <br>
                        <label>File Name: </label><span id="media-meta-filename"></span>
                        <br>
                        <label>File Type: </label><span id="media-meta-type"></span>
                        <br>
                        <label>File Size: </label><span id="media-meta-size"></span>
                        <br>
                        <label>Uploaded At: </label><span id="media-meta-created"></span>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Title</label>
                            <input id="media-meta-title" class="form-control input-sm" type="text" name="{{ md5('media-title') }}">
                        </div>
                        <div class="form-group">
                            <label>Caption</label>
                            <input id="media-meta-caption" class="form-control input-sm" type="text" name="{{ md5('media-caption') }}">
                        </div>
                        <div class="form-group">
                            <label>Alt Text</label>
                            <input id="media-meta-alt" class="form-control input-sm" type="text" name="{{ md5('media-alt') }}">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea id="media-meta-desc" class="form-control input-sm" name="{{ md5('media-desc') }}"></textarea>
                        </div>
                    </div>
                    <input id="media-meta-index" type="hidden">
                    <input type="hidden" name="{{ md5('process-option') }}" value="{{ md5('yesIWantToEdit') }}">
                    <input type="hidden" name="{{ md5('process-type') }}" value="{{ md5('media') }}">
                    <input type="hidden" name="{{ md5('media-type') }}" value="{{ md5('picture') }}">
                </form>
            </div>
        </div>
        <br>
        <div class="media-footer text-right">
            <small id="media-button-update" class="btn bg-{{ $themeColor }} btn-sm media-click none" value="update">Update</small>
            <small id="media-button-close" class="btn btn-no btn-sm media-click" value="close">Close</small>
        </div>
    </div>
</div>
