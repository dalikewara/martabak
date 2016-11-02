<style>
    .metas-box {
        padding: 10px 20px;
        box-sizing: border-box;
        transition: all 0.2s;
    }
    .metas-box:hover {
        background: rgb(240, 240, 240);
    }
</style>
<div id="content-layout" class="content-layout">



    <!-- Delete all metas -->
    <small class="content-edit-items">
        <strong class="content-edit-items-text content-edit-items-text-delete content-edit-items-text-delete-all" value="all">Delete all metas</strong>
    </small>
    <span id="content-delete-section-all" class="content-delete-section">
        <span>Are you sure to delete all metas permanently?</span>
        <strong id="content-delete-confirm-all" class="content-delete-confirm-all" valIndex="Meta" valId="all" valUrl="<?php echo $datas['uri']['delete']; ?>">Yes</strong>
    </span>
    <!-- Delete all metas -->



    <br><br>
    <div id="content-layout-child" class="content-layout-child">
        <?php foreach($datas['all'] as $data): ?>
            <!-- Content parent box -->
            <div id="meta-<?php echo $data->id; ?>" class="content-parent metas-box">



                <!-- Content main box -->
                <div class="content-main-box metas-item">
                    <p>
                        <strong>Custom id</strong> :
                        <span id="content-main-custom-id-<?php echo $data->id; ?>" class="meta-content-title"><?php echo $data->custom_id; ?></span> |
                        <strong>Type</strong> :
                        <span id="content-main-type-<?php echo $data->id; ?>" class="meta-content-uri"><?php echo $data->type; ?></span> |
                        <strong>Name</strong> :
                        <span id="content-main-title-<?php echo $data->id; ?>" class="meta-content-method"><?php echo $data->name; ?></span> |
                        <strong>Value1</strong> :
                        <span id="content-main-value1-<?php echo $data->id; ?>" class="meta-content-value"><?php echo $data->value1; ?></span> |
                        <strong>Value2</strong> :
                        <span id="content-main-value2-<?php echo $data->id; ?>" class="meta-content-value"><?php echo $data->value2; ?></span> |
                        <strong>Value3</strong> :
                        <span id="content-main-value3-<?php echo $data->id; ?>" class="meta-content-value"><?php echo $data->value3; ?></span> |
                        <strong>Value4</strong> :
                        <span id="content-main-value4-<?php echo $data->id; ?>" class="meta-content-value"><?php echo $data->value4; ?></span> |
                        <strong>Value5</strong> :
                        <span id="content-main-value5-<?php echo $data->id; ?>" class="meta-content-value"><?php echo $data->value5; ?></span> |
                        <strong>Value6</strong> :
                        <span id="content-main-value6-<?php echo $data->id; ?>" class="meta-content-value"><?php echo $data->value6; ?></span> |
                    </p>
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



                    <!-- Content edit item | delete -->
                    <small class="content-edit-items">
                        <strong class="content-edit-items-text content-edit-items-text-delete" value="<?php echo $data->id; ?>"><i class="fa fa-remove" aria-hidden="true"></i> Delete</strong>
                    </small>
                    <!-- Content edit item | delete -->



                </div>
                <!-- Content edit box -->



                <!-- Content edit section -->
                <span id="content-delete-section-<?php echo $data->id; ?>" class="content-delete-section content-display">
                    <span>Are you sure to delete this meta permanently?</span>
                    <strong id="content-delete-confirm-<?php echo $data->id; ?>" class="content-delete-confirm" valIndex="Meta" valId="<?php echo $data->id; ?>" valUrl="<?php echo $datas['uri']['delete']; ?>" valTitle="<?php echo $data->prefix; ?>">Yes</strong>
                </span>
                <div id="content-quick-edit-section-<?php echo $data->id; ?>" class="content-quick-edit-section content-display">
                    <form id="content-quick-edit-form-<?php echo $data->id; ?>" class="content-quick-edit-form" action="">
                        <label>Custom id:</label>
                        <input id="content-quick-edit-input-custom-id-<?php echo $data->id; ?>" class="L-input-1-s prefix-input" type="text" name="custom_id" value="<?php echo $data->custom_id; ?>">
                        <label>Type:</label>
                        <input id="content-quick-edit-input-type-<?php echo $data->id; ?>" class="L-input-1-s slug-input" type="text" name="type" value="<?php echo $data->type; ?>">
                        <label>Name: </label>
                        <input id="content-quick-edit-input-title-<?php echo $data->id; ?>" class="L-input-1-s slug-input" type="text" name="name" value="<?php echo $data->name; ?>">
                        <label>Value1:</label>
                        <input id="content-quick-edit-input-value1-<?php echo $data->id; ?>" class="L-input-1-s target-input" type="text" name="value1" value="<?php echo $data->value1; ?>">
                        <label>Value2:</label>
                        <input id="content-quick-edit-input-value2-<?php echo $data->id; ?>" class="L-input-1-s target-input" type="text" name="value2" value="<?php echo $data->value2; ?>">
                        <label>Value3:</label>
                        <input id="content-quick-edit-input-value3-<?php echo $data->id; ?>" class="L-input-1-s target-input" type="text" name="value3" value="<?php echo $data->value3; ?>">
                        <label>Value4:</label>
                        <input id="content-quick-edit-input-value4-<?php echo $data->id; ?>" class="L-input-1-s target-input" type="text" name="value4" value="<?php echo $data->value4; ?>">
                        <label>Value5:</label>
                        <textarea id="content-quick-edit-input-value5-<?php echo $data->id; ?>" class="L-textarea-1-s" name="value5" rows="8" cols="40"><?php echo $data->value5; ?></textarea>
                        <label>Value6:</label>
                        <input id="content-quick-edit-input-value6-<?php echo $data->id; ?>" class="L-input-1-s target-input" type="text" name="value6" value="<?php echo $data->value6; ?>">
                        <input type="hidden" name="id" value="<?php echo $data->id; ?>">
                        <input type="hidden" name="__token" value="">
                    </form>
                    <button id="content-quick-edit-confirm-<?php echo $data->id; ?>" class="L-button-4-s content-quick-edit-confirm" type="button" name="button" valIndex="Meta" valId="<?php echo $data->id; ?>" valUrl="<?php echo $datas['uri']['edit']; ?>">Save</button>
                </div>
                <!-- Content edit section -->



            </div>
            <!-- Content parent box -->
        <?php endforeach; ?>
    </div>



    <!-- Pagination -->
    <div id="meta-pagination" class="pagination-box pagination">
        <?php echo $datas['pagination']; ?>
    </div>
    <!-- Pagination -->



</div>
