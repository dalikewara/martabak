<!DOCTYPE html>
<html>
    <head>



        <?php require_once $path->layouts . '/metas.php'; ?>



    </head>
    <style>
        #overview-box {
            margin: 20px 0 0;
        }
        #note-box {
            width: 100%;
            color: rgb(255, 255, 255);
        }
        #child-inner-left {
            width: 450px;
        }
        #note-box-inner {
            padding: 10px 20px;
            background: rgb(113, 199, 83);
        }
        #note-box-inner h3 {
            margin-top: 0;
        }
        #all-notes {
            margin-top: 6px;
        }
        #content-menu {
            margin: 16px 0 20px;
        }
        #hidden-content-box {
            display: none;
            visibility: hidden;
            margin: 0 0 40px;
        }
        #loading-indicator {
            display: none;
            visibility: hidden;
        }
        .overview-box-inner {
            display: flex;
            margin: -10px 0 -25px;
        }
        .overview-box-section-left {
            width: 120px;
        }
        .overview-box-section-right {
            width: 100%;
        }
        .overview-box-section-value {
            display: flex;
        }
        .overview-box-section-value-left {
            width: 10px;
        }
        .overview-box-section-value-right {
            width: 100%;
        }
        .content-menu-title {
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
        }
        .menu-active {
            color: rgb(113, 199, 83);
            border-bottom: 1px solid rgb(113, 199, 83);
        }
        @media only screen and (max-width: 600px)
        {
            #hidden-content-box {
                display: block;
                visibility: visible;
            }
            .overview-box-inner {
                margin: 0 0 -20px;
            }
        }
    </style>
    <body>



        <?php require_once $path->layouts . '/panel.php'; ?>
        <?php require_once $path->layouts . '/notice.php'; ?>



        <div id="parent">
            <div id="child">
                <div id="child-inner-left">
                    <div class="child-section">
                        <h3>Overview</h3>
                        <hr>
                        <div id="overview-box">
                            <div class="overview-box-inner">
                                <div class="overview-box-section-left">
                                    <p class="overview-box-title"><strong><i class="fa fa-angle-right" aria-hidden="true"></i> Contents</strong></p>
                                </div>
                                <div class="overview-box-section-right">
                                    <div class="overview-box-section-value">
                                        <div class="overview-box-section-value-left">
                                            <p>:</p>
                                        </div>
                                        <div class="overview-box-section-value-right">
                                            <p>



                                                <b><?php echo $totals['pages']; ?></b> Pages
                                                <br>
                                                <b><?php echo $totals['controllers']; ?></b> Controllers
                                                <br>
                                                <b><?php echo $totals['routes']; ?></b> Routes
                                                <br>
                                                <b><?php echo $totals['layouts']; ?></b> Layouts
                                                <br>
                                                <b><?php echo $totals['metas']; ?></b> Custom Metas



                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="overview-box-inner">
                                <div class="overview-box-section-left">
                                    <p class="overview-box-title"><strong><i class="fa fa-angle-right" aria-hidden="true"></i> Storage</strong></p>
                                </div>
                                <div class="overview-box-section-right">
                                    <div class="overview-box-section-value">
                                        <div class="overview-box-section-value-left">
                                            <p>:</p>
                                        </div>
                                        <div class="overview-box-section-value-right">
                                            <p>300Kb</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="overview-box-inner">
                                <div class="overview-box-section-left">
                                    <p class="overview-box-title"><strong><i class="fa fa-angle-right" aria-hidden="true"></i> Logs</strong></p>
                                </div>
                                <div class="overview-box-section-right">
                                    <div class="overview-box-section-value">
                                        <div class="overview-box-section-value-left">
                                            <p>:</p>
                                        </div>
                                        <div class="overview-box-section-value-right">
                                            <div id="logs-box" value="<?php echo $uri->all_logs; ?>">
                                                <p><small>Loading logs...</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="child-inner-right">
                    <div class="child-section">
                        <div id="hidden-content-box">
                            <h3>Contents</h3>
                            <hr>
                        </div>



                        <!-- START NOTE BOX -->
                        <div id="note-box">
                            <div id="note-box-inner" class="L-box-1">
                                <?php if(!empty($note)): ?>
                                    <h3><?php echo $note[0]->title; ?></h3>
                                    <p><?php echo $note[0]->message; ?></p>
                                    <small>Wrote at <?php echo $note[0]->created_at; ?></small> |
                                    <small>Last edited at <?php echo $note[0]->updated_at; ?></small>
                                <?php else: ?>
                                    <h3>Welcome to backend! Lets's get started by creating new page.</h3>
                                    <p>
                                        You don't have a note yet. If you have text/message you
                                        want to placed here, or something to use as reminder, just <a href="">write a new one</a>.
                                    </p>
                                    <small>Wrote at 00-00-0000 00:00:00</small> |
                                    <small>Last edited at 00-00-0000 00:00:00</small>
                                <?php endif; ?>
                            </div>
                            <?php if($totals['notes'] > 1): ?>
                                <small id="all-notes" style="display:block"><a href="<?php echo $uri->notes; ?>">See all notes...</a></small>
                            <?php endif; ?>
                        </div>
                        <!-- END NOTE BOX -->



                        <div id="content-menu">
                            <span id="content-menu-page" class="content-menu-title menu-active" value="<?php echo $uri->all_pages; ?>" indicator="pages">Pages</span> |
                            <span id="content-menu-controller" class="content-menu-title" value="<?php echo $uri->all_controllers; ?>" indicator="controllers">Controllers</span> |
                            <span id="content-menu-route" class="content-menu-title" value="<?php echo $uri->all_routes; ?>" indicator="routes">Registered Routes</span> |
                            <span id="content-menu-page" class="content-menu-title" value="<?php echo $uri->all_layouts; ?>" indicator="layouts">Layouts</span> |
                            <span id="content-menu-page" class="content-menu-title" value="<?php echo $uri->all_metas; ?>" indicator="metas">Metas</span>
                        </div>
                        <div id="page-content-parent">
                            <div id="page-content-child">
                                <small>Loading pages...</small>
                            </div>
                            <small id="loading-indicator"></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <?php require_once $path->layouts . '/footer.php'; ?>



    </body>
    <script>
        var paginationUrl = Petis('#content-menu-page').attr('value');
        Petis('#logs-box').load(Petis('#logs-box').attr('value') + '?identifier=dashboard');
        Petis('#page-content-child').load(Petis('#content-menu-page').attr('value'));

        // Content menu
        Petis('.content-menu-title').on('click', function(e)
        {
            e.preventDefault();
            Petis('#page-content-child').hide();
            Petis('#loading-indicator').inner('Loading ' + Petis(this).attr('indicator') + '... Please wait...');
            Petis('#loading-indicator').show();
            Petis('.content-menu-title').style({color: 'rgb(100, 100, 100)',borderBottom: '0 solid white'});
            Petis(this).style({color: 'rgb(113, 199, 83)',borderBottom: '1px solid rgb(113, 199, 83)'});
            Petis('#page-content-child').load(Petis(this).attr('value'), function()
            {
                Petis('#loading-indicator').hide();
                Petis('#page-content-child').show();
            });

            paginationUrl = Petis(this).attr('value');
        });

        // Confirm delete all
        Petis('.content-delete-confirm-all').on('click', function(e)
        {
            e.preventDefault();

            var index = Petis(this).attr('valIndex');
                id = Petis(this).attr('valId');

            ajax(Petis(this).attr('valUrl'), 'id=' + id, 'All ' + index.toLowerCase() + 's' +
                ' have been deleted succesfully!', false, true, function()
                {
                    Petis('#content-layout').inner('<i>' + index + 's was cleaned.</i>');
                });
        });

        // Confirm delete
        Petis('.content-delete-confirm').on('click', function(e)
        {
            e.preventDefault();

            var index = Petis(this).attr('valIndex');
                id = Petis(this).attr('valId');

            ajax(Petis(this).attr('valUrl'), 'id=' + id + '&title=' + Petis('#content-delete-confirm-'
                + id).attr('valTitle'), index + ' has been deleted succesfully!', '#' +
                index.toLowerCase() + '-' + id, true);
        });

        // Confirm status
        Petis('.content-status-confirm').on('click', function(e)
        {
            e.preventDefault();

            var index = Petis(this).attr('valIndex');
                id = Petis(this).attr('valId');
                status = Petis(this).attr('valStatus');

            ajax(Petis(this).attr('valUrl'), 'id=' + id + '&title=' + Petis(this).attr('valTitle')
                + '&change_status=1&slug=null&status=' + status + '&desc=', index +
                ' has been updated succesfully!', false, true, function()
                {
                    if(status == 1)
                    {
                        Petis('#content-main-title-label-' + id).inner('Published');
                        Petis('#content-main-title-label-' + id).attr('class', 'L-label-1-primary');
                        Petis('#content-edit-status-text-' + id).inner('Make as draft');
                        Petis('#content-status-confirm-' + id).attr('valStatus', 2);
                        Petis('#content-status-confirm-text-' + id).inner('Are you sure to make this page as draft?');
                    }
                    else if(status == 2)
                    {
                        Petis('#content-main-title-label-' + id).inner('Drafted');
                        Petis('#content-main-title-label-' + id).attr('class', 'L-label-1-warning');
                        Petis('#content-edit-status-text-' + id).inner('Publish this');
                        Petis('#content-status-confirm-' + id).attr('valStatus', 1);
                        Petis('#content-status-confirm-text-' + id).inner('Are you sure to publish this page?');
                    }
                });
        });

        // Save edit
        Petis('.content-quick-edit-confirm').on('click', function(e)
        {
            e.preventDefault();

            var id = Petis(this).attr('valId');
            var index = Petis(this).attr('valIndex');

            if(index === 'Route')
            {
                var data = 'id=' + id + '&prefix=' + Petis('#content-quick-edit-input-title-'
                    + id).val + '&uri=' + Petis('#content-quick-edit-input-uri-'
                        + id).val + '&method=' + Petis('#content-quick-edit-input-method-'
                            + id).attr('value') + '&target=' + Petis('#content-quick-edit-input-target-'
                                + id).val + '&__token=';
            }
            else
            {
                var data = Petis('#content-quick-edit-form-' + id).getFormData();
            }

            ajax(Petis(this).attr('valUrl'), data, index + ' has been edited succesfully!',
                false, true, function()
                {
                    var title = Petis('#content-quick-edit-input-title-' + id).val;

                    Petis('#content-main-title-' + id).inner(title);
                    Petis('#content-main-title-' + id).attr('href', Petis(
                        '#content-quick-edit-input-slug-' + id).val);
                    Petis('#content-main-description-' + id).inner(Petis(
                        '#content-quick-edit-input-description-' + id).val);
                    Petis('#content-main-comment-' + id).inner(Petis(
                        '#content-quick-edit-input-comment-' + id).val);
                    Petis('#content-main-last-edited-' + id).inner('Last edited: recent');
                    Petis('#content-delete-confirm-' + id).attr('valTitle', title);

                    if(index === 'Route')
                    {
                        Petis('#content-main-uri-' + id).inner(Petis('#content-quick-edit-input-uri-'
                            + id).val);
                        Petis('#content-main-method-' + id).inner(Petis('#content-quick-edit-input-method-'
                            + id).attr('value'));
                        Petis('#content-main-target-' + id).inner(Petis('#content-quick-edit-input-target-'
                            + id).val);
                    }
                    else if(index === 'Meta')
                    {
                        Petis('#content-main-custom-id-' + id).inner(Petis(
                            '#content-quick-edit-input-custom-id-' + id).val);
                        Petis('#content-main-type-' + id).inner(Petis(
                            '#content-quick-edit-input-type-' + id).val);
                        Petis('#content-main-value1-' + id).inner(Petis(
                            '#content-quick-edit-input-value1-' + id).val);
                        Petis('#content-main-value2-' + id).inner(Petis(
                            '#content-quick-edit-input-value2-' + id).val);
                        Petis('#content-main-value3-' + id).inner(Petis(
                            '#content-quick-edit-input-value3-' + id).val);
                        Petis('#content-main-value4-' + id).inner(Petis(
                            '#content-quick-edit-input-value4-' + id).val);
                        Petis('#content-main-value5-' + id).inner(Petis(
                            '#content-quick-edit-input-value5-' + id).val);
                        Petis('#content-main-value6-' + id).inner(Petis(
                            '#content-quick-edit-input-value6-' + id).val);
                    }
                });
        });

        // Route method
        Petis('.method-input').on('click', function()
        {
            var id = Petis(this).attr('valId');

            Petis('#content-quick-edit-input-method-' + id).attr('value', Petis(this).attr('value'));
        });

        // Pagination
        pagination(paginationUrl, '#page-content-child');
    </script>
</html>
