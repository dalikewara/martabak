<style media="screen">
    .notes-box {
        margin: 0 0 25px;
    }
    .notes-item {
        padding: 0 10px;
        background: rgb(113, 199, 83);
        color: rgb(255, 255, 255);
    }
</style>


<div id="content-layout" class="content-layout">



    <!-- Delete all notes -->
    <small class="content-edit-items">
        <strong class="content-edit-items-text content-edit-items-text-delete content-edit-items-text-delete-all" value="all">Delete all notes</strong>
    </small>
    <span id="content-delete-section-all" class="content-delete-section">
        <span>Are you sure to delete all notes permanently?</span>
        <strong id="content-delete-confirm-all" class="content-delete-confirm-all" valIndex="Note" valId="all" valUrl="<?php echo $datas['uri']['delete']; ?>">Yes</strong>
    </span>
    <!-- Delete all notes -->



    <br><br>
    <div id="content-layout-child" class="content-layout-child">
        <?php foreach($datas['all'] as $data): ?>
            <!-- Content parent box -->
            <div id="note-<?php echo $data->id; ?>" class="content-parent notes-box">



                <!-- Content main box -->
                <div class="content-main-box L-box-1 notes-item">
                    <h3 id="content-main-title-<?php echo $data->id; ?>"><?php echo $data->title; ?></h3>
                    <p id="content-main-message-<?php echo $data->id; ?>"><?php echo $data->message; ?></p>
                    <small>Wrote at <?php echo $data->created_at; ?></small> |
                    <small id="content-main-last-edited-<?php echo $data->id; ?>">Last edited at <?php echo $data->updated_at; ?></small>
                </div>
                <!-- Content main box -->



                <!-- Content edit box -->
                <div class="content-edit-box">



                    <!-- Content edit item | quick edit -->
                    <small class="content-edit-items">
                        <strong class="content-edit-items-text content-edit-items-text-quick-edit" value="<?php echo $data->id; ?>"><i class="fa fa-edit" aria-hidden="true"></i> Edit note</strong>
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
                <span id="content-delete-section-<?php echo $data->id; ?>" class="content-delete-section">
                    <span>Are you sure to delete this note permanently?</span>
                    <strong id="content-delete-confirm-<?php echo $data->id; ?>" class="content-delete-confirm" valIndex="Note" valId="<?php echo $data->id; ?>" valUrl="<?php echo $datas['uri']['delete']; ?>" valTitle="<?php echo $data->title; ?>">Yes</strong>
                </span>
                <div id="content-quick-edit-section-<?php echo $data->id; ?>" class="content-quick-edit-section">
                    <form id="content-quick-edit-form-<?php echo $data->id; ?>" class="content-quick-edit-form" action="">
                        <label>Title:</label>
                        <input id="content-quick-edit-input-title-<?php echo $data->id; ?>" class="L-input-1-s" type="text" name="title" value="<?php echo $data->title; ?>">
                        <label>Message:</label>
                        <textarea id="content-quick-edit-input-textarea-<?php echo $data->id; ?>" class="L-textarea-1-s" name="message" rows="8" cols="40"><?php echo $data->message; ?></textarea>
                        <input type="hidden" name="id" value="<?php echo $data->id; ?>">
                        <input type="hidden" name="__token" value="">
                    </form>
                    <button id="content-quick-edit-confirm-<?php echo $data->id; ?>" class="L-button-1-s content-quick-edit-confirm" type="button" name="button" valIndex="Note" valId="<?php echo $data->id; ?>" valUrl="<?php echo $datas['uri']['edit']; ?>">Save</button>
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
