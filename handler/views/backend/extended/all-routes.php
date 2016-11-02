<style>
    .routes-box {
        padding: 10px 20px;
        box-sizing: border-box;
        transition: all 0.2s;
    }
    .routes-box:hover {
        background: rgb(240, 240, 240);
    }
</style>
<div id="content-layout" class="content-layout">



    <!-- Delete all routes -->
    <small class="content-edit-items">
        <strong class="content-edit-items-text content-edit-items-text-delete content-edit-items-text-delete-all" value="all">Delete all routes</strong>
    </small>
    <span id="content-delete-section-all" class="content-delete-section">
        <span>Are you sure to delete all routes permanently?</span>
        <strong id="content-delete-confirm-all" class="content-delete-confirm-all" valIndex="Route" valId="all" valUrl="<?php echo $datas['uri']['delete']; ?>">Yes</strong>
    </span>
    <!-- Delete all routes -->



    <br><br>
    <div id="content-layout-child" class="content-layout-child">
        <?php foreach($datas['all'] as $data): ?>
            <!-- Content parent box -->
            <div id="route-<?php echo $data->id; ?>" class="content-parent routes-box">



                <!-- Content main box -->
                <div class="content-main-box routes-item">
                    <p>
                        <strong>Prefix</strong> :
                        <span id="content-main-title-<?php echo $data->id; ?>" class="route-content-title"><?php echo $data->prefix; ?></span> |
                        <strong>Uri</strong> :
                        <span id="content-main-uri-<?php echo $data->id; ?>" class="route-content-uri"><?php echo $data->uri; ?></span> |
                        <strong>Method</strong> :
                        <span id="content-main-method-<?php echo $data->id; ?>" class="route-content-method"><?php echo $data->method; ?></span> |
                        <strong>Target</strong> :
                        <span id="content-main-target-<?php echo $data->id; ?>" class="route-content-target"><?php echo $data->target; ?></span>
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
                    <span>Are you sure to delete this route permanently?</span>
                    <strong id="content-delete-confirm-<?php echo $data->id; ?>" class="content-delete-confirm" valIndex="Route" valId="<?php echo $data->id; ?>" valUrl="<?php echo $datas['uri']['delete']; ?>" valTitle="<?php echo $data->prefix; ?>">Yes</strong>
                </span>
                <div id="content-quick-edit-section-<?php echo $data->id; ?>" class="content-quick-edit-section content-display">
                    <form id="content-quick-edit-form-<?php echo $data->id; ?>" class="content-quick-edit-form" action="">
                        <label>Prefix:</label>
                        <input id="content-quick-edit-input-title-<?php echo $data->id; ?>" class="L-input-1-s prefix-input" type="text" name="prefix" value="<?php echo $data->prefix; ?>">
                        <label>Uri:</label>
                        <input id="content-quick-edit-input-uri-<?php echo $data->id; ?>" class="L-input-1-s slug-input" type="text" name="uri" value="<?php echo $data->uri; ?>">
                        <label>Method: </label>
                        <span id="content-quick-edit-input-method-<?php echo $data->id; ?>" value="<?php echo $data->method; ?>"></span>
                        <br>
                        <?php if($data->method === 'GET'): ?>
                            <input class="method-input" type="radio" name="method" value="GET" valId="<?php echo $data->id; ?>" checked> GET
                            <input class="method-input" type="radio" name="method" value="POST" valId="<?php echo $data->id; ?>"> POST
                        <?php else: ?>
                            <input class="method-input" type="radio" name="method" value="GET" valId="<?php echo $data->id; ?>"> GET
                            <input class="method-input" type="radio" name="method" value="POST" valId="<?php echo $data->id; ?>" checked> POST
                        <?php endif; ?>
                        <br><br>
                        <label>Target:</label>
                        <input id="content-quick-edit-input-target-<?php echo $data->id; ?>" class="L-input-1-s target-input" type="text" name="target" value="<?php echo $data->target; ?>">
                        <input type="hidden" name="id" value="<?php echo $data->id; ?>">
                        <input type="hidden" name="__token" value="">
                    </form>
                    <button id="content-quick-edit-confirm-<?php echo $data->id; ?>" class="L-button-4-s content-quick-edit-confirm" type="button" name="button" valIndex="Route" valId="<?php echo $data->id; ?>" valUrl="<?php echo $datas['uri']['edit']; ?>">Save</button>
                </div>
                <!-- Content edit section -->



            </div>
            <!-- Content parent box -->
        <?php endforeach; ?>
    </div>



    <!-- Pagination -->
    <div id="route-pagination" class="pagination-box pagination">
        <?php echo $datas['pagination']; ?>
    </div>
    <!-- Pagination -->



</div>
