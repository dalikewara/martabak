<?php if($datas['identifier'] !== 'logs' AND $datas['identifier'] !== 'default'): ?>
    <?php foreach($datas['all'] as $data): ?>
        <p class="logs-item"><?php echo $data->message; ?></p>
    <?php endforeach; ?>
    <?php if(count($datas['all']) === 10): ?>
        <p><small><a href="<?php echo $datas['uri']['all']; ?>">View all logs...</a></small></p>
    <?php endif; ?>
<?php else: ?>
    <div id="content-layout" class="content-layout">



        <!-- Delete all logs -->
        <small class="content-edit-items">
            <strong class="content-edit-items-text content-edit-items-text-delete content-edit-items-text-delete-all" value="all">Clean logs</strong>
        </small>
        <span id="content-delete-section-all" class="content-delete-section">
            <span>Are you sure to clean all logs permanently?</span>
            <strong id="content-delete-confirm-all" class="content-delete-confirm-all" valIndex="Log" valId="all" valUrl="<?php echo $datas['uri']['delete']; ?>">Yes</strong>
        </span>
        <!-- Delete all logs -->



        <br><br>
        <div id="content-layout-child" class="content-layout-child">
            <?php foreach($datas['all'] as $data): ?>
                <!-- Content parent box -->
                <div id="note-<?php echo $data->id; ?>" class="content-parent notes-box">



                    <!-- Content main box -->
                    <div class="content-main-box logs-item">
                        <p class="logs-item"><?php echo $data->message; ?></p>
                    </div>
                    <!-- Content main box -->



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
<?php endif; ?>
