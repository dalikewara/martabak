<style>
    .controllers-box {
        padding: 10px 20px;
        box-sizing: border-box;
        transition: all 0.2s;
    }
    .controllers-box:hover {
        background: rgb(240, 240, 240);
    }
</style>
<div id="content-layout" class="content-layout">



    <!-- Delete all controllers -->
    <small class="content-edit-items">
        <strong class="content-edit-items-text content-edit-items-text-delete content-edit-items-text-delete-all" value="all">Delete all controllers</strong>
    </small>
    <span id="content-delete-section-all" class="content-delete-section">
        <span>Are you sure to delete all controllers permanently?</span>
        <strong id="content-delete-confirm-all" class="content-delete-confirm-all" valIndex="Controller" valId="all" valUrl="<?php echo $datas['uri']['delete']; ?>">Yes</strong>
    </span>
    <!-- Delete all controllers -->



    <br><br>
    <div id="content-layout-child" class="content-layout-child">
        <?php foreach($datas['all'] as $data): ?>
            <!-- Content parent box -->
            <div id="controller-<?php echo $data->id; ?>" class="content-parent controllers-box">



                <!-- Content main box -->
                <div class="content-main-box controllers-item">
                    <p>
                        <small>Created at <?php echo $data->created_at; ?></small> |
                        <small id="content-main-last-edited-<?php echo $data->id; ?>">Updated at <?php echo $data->updated_at; ?></small>
                    </p>
                    <?php if(!empty($data->comment)): ?>
                        <p>
                            /* <i id="content-main-comment-<?php echo $data->id; ?>"><?php echo $data->comment; ?></i> */
                        </p>
                    <?php endif; ?>
                    <p class="controller-content-title">
                        <span>Controller name: </span>
                        <strong id="content-main-title-<?php echo $data->id; ?>"><?php echo $data->name; ?></strong>
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
                        <strong class="content-edit-items-text content-edit-items-text-edit" value="<?php echo $data->id; ?>"><a href="<?php echo $datas['uri']['edit_controller']; ?>&id=<?php echo $data->id; ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a></strong>
                    </small>
                    <!-- Content edit item | edit -->



                    <!-- Content edit item | delete -->
                    <small class="content-edit-items">
                        <strong class="content-edit-items-text content-edit-items-text-delete" value="<?php echo $data->id; ?>"><i class="fa fa-remove" aria-hidden="true"></i> Delete</strong>
                    </small>
                    <!-- Content edit item | delete -->



                </div>
                <!-- Content edit box -->



                <!-- Content edit section -->
                <span id="content-delete-section-<?php echo $data->id; ?>" class="content-delete-section content-display">
                    <span>Are you sure to delete this controller permanently?</span>
                    <strong id="content-delete-confirm-<?php echo $data->id; ?>" class="content-delete-confirm" valIndex="Controller" valId="<?php echo $data->id; ?>" valUrl="<?php echo $datas['uri']['delete']; ?>" valTitle="<?php echo $data->name; ?>">Yes</strong>
                </span>
                <div id="content-quick-edit-section-<?php echo $data->id; ?>" class="content-quick-edit-section content-display">
                    <form id="content-quick-edit-form-<?php echo $data->id; ?>" class="content-quick-edit-form" action="">
                        <label>Name:</label>
                        <input id="content-quick-edit-input-title-<?php echo $data->id; ?>" class="L-input-1-s name-input" type="text" name="title" value="<?php echo $data->name; ?>">
                        <label>Comment:</label>
                        <textarea id="content-quick-edit-input-comment-<?php echo $data->id; ?>" class="L-textarea-1-s" name="comment" rows="8" cols="40"><?php echo $data->comment; ?></textarea>
                        <input type="hidden" name="id" value="<?php echo $data->id; ?>">
                        <input type="hidden" name="status" value="<?php echo $data->status; ?>">
                        <input type="hidden" name="__token" value="">
                    </form>
                    <button id="content-quick-edit-confirm-<?php echo $data->id; ?>" class="L-button-4-s content-quick-edit-confirm" type="button" name="button" valIndex="Controller" valId="<?php echo $data->id; ?>" valUrl="<?php echo $datas['uri']['edit']; ?>">Save</button>
                </div>
                <!-- Content edit section -->



            </div>
            <!-- Content parent box -->
        <?php endforeach; ?>
    </div>



    <!-- Pagination -->
    <div id="controller-pagination" class="pagination-box pagination">
        <?php echo $datas['pagination']; ?>
    </div>
    <!-- Pagination -->



</div>
