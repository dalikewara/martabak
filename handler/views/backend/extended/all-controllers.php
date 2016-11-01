<!-- START CONTROLLER CONTENT BOX -->
<style>
    .controller-content-items {
        border-bottom: 1px solid rgb(214, 214, 214);
        padding: 10px 20px;
        transition: all 0.2s;
    }
    .controller-content-items:hover {
        background: rgb(248, 248, 248);
    }
    .controller-content-comment {
        color: rgb(185, 185, 185);
    }
    .controller-content-name, .controller-content-comment {
        font-size: 13px;
    }
    .controller-content-quick-edit-box {
        width: 100%;
        background: rgb(235, 235, 235);
        margin: -10px 0 10px;
        display: none;
        visibility: hidden;
    }
    .controller-content-quick-edit-box-inner {
        padding: 10px;
    }
    .controller-content-edit-menu {
        cursor: pointer;
    }
    .controller-content-edit-menu:hover {
        color: rgb(0, 0, 0);
    }
    .controller-content-quick-edit-form label {
        font-size: 13px;
    }
    .controller-content-confirm-delete {
        display: none;
        visibility: hidden;
    }
    .controller-content-confirm-delete-yes {
        color: rgb(200, 48, 75);
    }
    .controller-content-confirm-delete-yes:hover {
        color: rgb(255, 0, 0);
    }
    .controller-content-confirm-delete-no:hover {
        color: rgb(115, 115, 115);
    }
</style>
<?php for($i = 0; $i < 10; $i++): ?>
<div class="controller-content-items">
    <div class="controller-content-items-inner">
        <span class="controller-content-comment"><i><code>/* Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente unde impedit culpa quos, enim quia voluptatem, corporis necessitatibus dolor, ea accusamus ratione asperiores. Dolore, ullam, neque suscipit non dolores natus.*/</code></i></span>
        <br>
        <span class="controller-content-name"><strong>UserController</strong></span>,
        <span class="controller-content-name">syntax usage = <code class="L-code-1">new Controller('UserController');</code></span>
        <p>
            <small class="controller-content-comment">// <i>Created at 00-00-000 00:00:00</i></small>
            <br>
            <small id="controller-content-quick-edit-<?php echo $i; ?>" class="controller-content-edit-menu controller-content-quick-edit-text" value="<?php echo $i; ?>"><strong><i class="fa fa-edit" aria-hidden="true"></i> Quick edit</strong></small> |
            <small class="controller-content-edit-menu"><a href=""><strong><i class="fa fa-pencil" aria-hidden="true"></i> Edit</strong></a></small> |
            <small class="controller-content-edit-menu">
                <strong class="controller-content-delete-text" value="<?php echo $i; ?>"><i class="fa fa-remove" aria-hidden="true"></i> Delete</strong>
                <span id="controller-content-confirm-delete-<?php echo $i; ?>" class="controller-content-confirm-delete">
                    <span>Are you sure to delete this controller permanently?</span>
                    <strong id="controller-content-confirm-delete-yes-<?php echo $i; ?>" class="controller-content-confirm-delete-yes">Yes</strong>
                </span>
            </small>
        </p>
        <div id="controller-content-quick-edit-box-<?php echo $i; ?>" class="controller-content-quick-edit-box">
            <div class="controller-content-quick-edit-box-inner">
                <form id="controller-content-quick-edit-form-<?php echo $i; ?>" class="controller-content-quick-edit-form">
                    <input class="L-input-1-s" type="text">
                </form>
                <button class="L-button-4-s">Save</button>
            </div>
        </div>
    </div>
</div>
<?php endfor; ?>
<script>
    petis.set.event('click', '.controller-content-quick-edit-text', function()
    {
        var val = petis.get.attribute(this, 'value');
        var cEditMenu = '#controller-content-quick-edit-box-' + val;

        petis.set.feature({
            name: 'toggleDropdown',
            element: this,
            target: cEditMenu,
        }, false);
    });

    petis.set.event('click', '.controller-content-delete-text', function()
    {
        var val = petis.get.attribute(this, 'value');
        var cDelConf = '#controller-content-confirm-delete-' + val;

        petis.set.feature({
            name: 'toggleDropdown',
            element: this,
            target: cDelConf,
        }, false);
    });
</script>
<!-- END CONTROLLER CONTENT BOX -->
