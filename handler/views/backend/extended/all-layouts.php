<style>
    .layouts-box {
        padding: 10px 20px;
        box-sizing: border-box;
        transition: all 0.2s;
    }
    .layouts-box:hover {
        background: rgb(240, 240, 240);
    }
</style>
<div id="content-layout" class="content-layout">



    <!-- Delete all layouts -->
    <small class="content-edit-items">
        <strong class="content-edit-items-text content-edit-items-text-delete content-edit-items-text-delete-all" value="all">Delete all layouts</strong>
    </small>
    <span id="content-delete-section-all" class="content-delete-section">
        <span>Are you sure to delete all layouts permanently?</span>
        <strong id="content-delete-confirm-all" class="content-delete-confirm-all" valIndex="Layout" valId="all" valUrl="<?php echo $datas['uri']['delete']; ?>">Yes</strong>
    </span>
    <!-- Delete all layouts -->



    <br><br>
    <div id="content-layout-child" class="content-layout-child">
        <?php foreach($datas['all'] as $data): ?>
            <!-- Content parent box -->
            <div id="layout-<?php echo $data->id; ?>" class="content-parent layouts-box">



                <!-- Content main box -->
                <div class="content-main-box layouts-item">
                    <p>
                        <strong id="content-main-title-<?php echo $data->id; ?>"><?php echo $data->name; ?></strong>
                        <br>
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



                    <!-- Content edit item | preview -->
                    <small class="content-edit-items">
                        <strong class="content-edit-items-text content-edit-items-text-preview" value="<?php echo $data->id; ?>"><i class="fa fa-edit" aria-hidden="true"></i> Preview</strong>
                    </small>
                    <!-- Content edit item | preview -->



                    <!-- Content edit item | delete -->
                    <small class="content-edit-items">
                        <strong class="content-edit-items-text content-edit-items-text-delete" value="<?php echo $data->id; ?>"><i class="fa fa-remove" aria-hidden="true"></i> Delete</strong>
                    </small>
                    <!-- Content edit item | delete -->



                </div>
                <!-- Content edit box -->



                <!-- Content edit section -->
                <span id="content-delete-section-<?php echo $data->id; ?>" class="content-delete-section content-display">
                    <span>Are you sure to delete this layout permanently?</span>
                    <strong id="content-delete-confirm-<?php echo $data->id; ?>" class="content-delete-confirm" valIndex="Layout" valId="<?php echo $data->id; ?>" valUrl="<?php echo $datas['uri']['delete']; ?>" valTitle="<?php echo $data->title; ?>">Yes</strong>
                </span>
                <div id="content-quick-edit-section-<?php echo $data->id; ?>" class="content-quick-edit-section content-display">
                    <form id="content-quick-edit-form-<?php echo $data->id; ?>" class="content-quick-edit-form" action="">
                        <label>Name:</label>
                        <input id="content-quick-edit-input-title-<?php echo $data->id; ?>" class="L-input-1-s name-input" type="text" name="name" value="<?php echo $data->name; ?>">
                        <label>Code:</label>
                        <textarea id="content-quick-edit-input-description-<?php echo $data->id; ?>" class="L-textarea-1-s" name="desc" rows="8" cols="40"></textarea>
                        <input type="hidden" name="id" value="<?php echo $data->id; ?>">
                        <input type="hidden" name="__token" value="">
                    </form>
                    <button id="content-quick-edit-confirm-<?php echo $data->id; ?>" class="L-button-4-s content-quick-edit-confirm" type="button" name="button" valIndex="Layout" valId="<?php echo $data->id; ?>" valUrl="<?php echo $datas['uri']['edit']; ?>">Save</button>
                </div>
                <!-- Content edit section -->



            </div>
            <!-- Content parent box -->
        <?php endforeach; ?>
    </div>



    <!-- Pagination -->
    <div id="layout-pagination" class="pagination-box pagination">
        <?php echo $datas['pagination']; ?>
    </div>
    <!-- Pagination -->



</div>
