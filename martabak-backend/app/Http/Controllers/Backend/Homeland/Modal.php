<?php

namespace App\Http\Controllers\Backend\Homeland;

class Modal
{
    public function chooseMedia()
    {

    }

    public function mediaInfo($themeColor, $url)
    {
        return
        '
            <div id="media-menu-detail" class="media-menu none">
                <div class="media-menu-inner bg-white shadow">
                    <div class="media-header">
                        <div class="media-menu-title text-center bg-white">
                            <h3>Details</h3>
                            <hr>
                        </div>
                    </div>
                    <div class="auto media-menu-content">
                        <form role="form">
                            <div class="review-picture col-sm-4">
                                <span><strong>Preview:</strong></span>
                                <br>
                                <div class="auto media-preview">
                                    <img class="img-responsive img-media-preview" src="/martabak-frontend/admin/assets/icons/post.png" alt="" />
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <small><strong>File url:</strong> ' . $url . '</small>
                                <br>
                                <small><strong>File name:</strong> mererjt fbjr jhrbt rtjnrt rjtt.jpeg</small>
                                <br>
                                <small><strong>Uploaded at:</strong> 0000-00-00 00:00:00</small>
                                <br>
                                <small><strong>File type:</strong> uefhr/jrh</small>
                                <br>
                                <small><strong>File size:</strong> 200</small>
                                <br>
                                <small><strong>Dimensions:</strong> 200 x 200</small>
                            </div>
                            <div class="review-properties col-sm-5">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input class="form-control input-sm" type="text" placeholder="Add media title">
                                </div>
                                <div class="form-group">
                                    <label>Caption</label>
                                    <textarea class="form-control input-sm" name="name" placeholder="Add media caption"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Alt Text</label>
                                    <input class="form-control input-sm" type="text" placeholder="Add media alt text">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control input-sm" name="name" placeholder="Add media description"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <br>
                    <div class="media-footer text-right">
                        <small class="btn bg-' . $themeColor . ' btn-sm save-unactive disable-pointer-events">Update</small>
                        <small class="btn btn-no btn-sm cancel">Cancel</small>
                    </div>
                </div>
            </div>
        ';
    }
}
