<style>
    .pages-box {
        padding: 10px 20px;
        box-sizing: border-box;
        transition: all 0.2s;
    }
    .pages-box:hover {
        background: rgb(240, 240, 240);
    }
</style>
<div id="content-layout" class="content-layout">



    <!-- Delete all pages -->
    <small class="content-edit-items">
        <strong class="content-edit-items-text content-edit-items-text-delete content-edit-items-text-delete-all" value="all">Delete all pages</strong>
    </small>
    <span id="content-delete-section-all" class="content-delete-section">
        <span>Are you sure to delete all pages permanently?</span>
        <strong id="content-delete-confirm-all" class="content-delete-confirm-all" valIndex="Page" valId="all" valUrl="<?php echo $datas['uri']['delete']; ?>">Yes</strong>
    </span>
    <!-- Delete all pages -->



    <br><br>
    <div id="content-layout-child" class="content-layout-child">
        <?php foreach($datas['all'] as $data): ?>
            <!-- Content parent box -->
            <div id="page-<?php echo $data->id; ?>" class="content-parent pages-box">



                <!-- Content main box -->
                <div class="content-main-box pages-item">
                    <p class="page-content-title">
                        <?php if($data->status == 1): ?>
                            <strong><a id="content-main-title-<?php echo $data->id; ?>" href="<?php echo $data->slug; ?>"><?php echo $data->title; ?></a></strong>
                            <span><small id="content-main-title-label-<?php echo $data->id; ?>" class="L-label-1-primary">Published</small></span>
                        <?php else: ?>
                            <strong id="content-main-title-<?php echo $data->id; ?>"><?php echo $data->title; ?></strong>
                            <span><small id="content-main-title-label-<?php echo $data->id; ?>" class="L-label-1-warning">Drafted</small></span>
                        <?php endif; ?>
                    </p>
                    <p id="content-main-description-<?php echo $data->id; ?>"><?php echo $data->description; ?></p>
                    <p>
                        <small>Created at <?php echo $data->created_at; ?></small> |
                        <small id="content-main-last-edited-<?php echo $data->id; ?>">Updated at <?php echo $data->updated_at; ?></small>
                    </p>
                </div>
                <!-- Content main box -->



                <!-- Content edit box -->
                <div class="content-edit-box">



                    <!-- Content edit item | quick edit -->
                    <small class="content-edit-items">
                        <strong class="content-edit-items-text content-edit-items-text-quick-edit" value="<?php echo $data->id; ?>"><i class="fa fa-edit" aria-hidden="true"></i> Quick edit</strong>
                    </small>
                    <!-- Content edit item | quick edit -->



                    <!-- Content edit item | edit -->
                    <small class="content-edit-items">
                        <strong class="content-edit-items-text content-edit-items-text-edit" value="<?php echo $data->id; ?>"><a href="<?php echo $datas['uri']['edit_page']; ?>&id=<?php echo $data->id; ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a></strong>
                    </small>
                    <!-- Content edit item | edit -->



                    <!-- Content edit item | status -->
                    <?php if($data->status == 1): ?>
                        <small class="content-edit-items">
                            <strong class="content-edit-items-text content-edit-items-text-status" value="<?php echo $data->id; ?>"><i class="fa fa-thumb-tack" aria-hidden="true"></i> <span id="content-edit-status-text-<?php echo $data->id; ?>">Make as draft</span></strong>
                        </small>
                    <?php else: ?>
                        <small class="content-edit-items">
                            <strong class="content-edit-items-text content-edit-items-text-status" value="<?php echo $data->id; ?>"><i class="fa fa-thumb-tack" aria-hidden="true"></i> <span id="content-edit-status-text-<?php echo $data->id; ?>">Publish this</span></strong>
                        </small>
                    <?php endif; ?>
                    <!-- Content edit item | status -->



                    <!-- Content edit item | delete -->
                    <small class="content-edit-items">
                        <strong class="content-edit-items-text content-edit-items-text-delete" value="<?php echo $data->id; ?>"><i class="fa fa-remove" aria-hidden="true"></i> Delete</strong>
                    </small>
                    <!-- Content edit item | delete -->



                </div>
                <!-- Content edit box -->



                <!-- Content edit section -->
                <span id="content-delete-section-<?php echo $data->id; ?>" class="content-delete-section content-display">
                    <span>Are you sure to delete this page permanently?</span>
                    <strong id="content-delete-confirm-<?php echo $data->id; ?>" class="content-delete-confirm" valIndex="Page" valId="<?php echo $data->id; ?>" valUrl="<?php echo $datas['uri']['delete']; ?>" valTitle="<?php echo $data->title; ?>">Yes</strong>
                </span>
                <span id="content-status-section-<?php echo $data->id; ?>" class="content-status-section content-display">
                    <?php if($data->status == 1): ?>
                        <span id="content-status-confirm-text-<?php echo $data->id; ?>">Are you sure to make this page as draft?</span>
                        <strong id="content-status-confirm-<?php echo $data->id; ?>" class="content-status-confirm" valIndex="Page" valId="<?php echo $data->id; ?>" valStatus="2" valUrl="<?php echo $datas['uri']['edit']; ?>" valTitle="<?php echo $data->title; ?>">Yes</strong>
                    <?php else: ?>
                        <span id="content-status-confirm-text-<?php echo $data->id; ?>">Are you sure to publish this page?</span>
                        <strong id="content-status-confirm-<?php echo $data->id; ?>" class="content-status-confirm" valIndex="Page" valId="<?php echo $data->id; ?>" valStatus="1" valUrl="<?php echo $datas['uri']['edit']; ?>" valTitle="<?php echo $data->title; ?>">Yes</strong>
                    <?php endif; ?>
                </span>
                <div id="content-quick-edit-section-<?php echo $data->id; ?>" class="content-quick-edit-section content-display">
                    <form id="content-quick-edit-form-<?php echo $data->id; ?>" class="content-quick-edit-form" action="">
                        <label>Title:</label>
                        <input id="content-quick-edit-input-title-<?php echo $data->id; ?>" class="L-input-1-s name-input" type="text" name="title" value="<?php echo $data->title; ?>">
                        <label>Slug:</label>
                        <input id="content-quick-edit-input-slug-<?php echo $data->id; ?>" class="L-input-1-s slug-input" type="text" name="slug" value="<?php echo $data->slug; ?>">
                        <label>Description:</label>
                        <textarea id="content-quick-edit-input-description-<?php echo $data->id; ?>" class="L-textarea-1-s" name="desc" rows="8" cols="40"><?php echo $data->description; ?></textarea>
                        <input type="hidden" name="id" value="<?php echo $data->id; ?>">
                        <input type="hidden" name="status" value="<?php echo $data->status; ?>">
                        <input type="hidden" name="__token" value="">
                    </form>
                    <button id="content-quick-edit-confirm-<?php echo $data->id; ?>" class="L-button-4-s content-quick-edit-confirm" type="button" name="button" valIndex="Page" valId="<?php echo $data->id; ?>" valUrl="<?php echo $datas['uri']['edit']; ?>">Save</button>
                </div>
                <!-- Content edit section -->



            </div>
            <!-- Content parent box -->
        <?php endforeach; ?>
    </div>



    <!-- Pagination -->
    <div id="page-pagination" class="pagination-box pagination">
        <?php echo $datas['pagination']; ?>
    </div>
    <!-- Pagination -->



</div>
