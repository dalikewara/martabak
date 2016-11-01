<!DOCTYPE html>
<html>
    <head>



        <?php require_once $path->layouts . '/metas.php'; ?>



    </head>
    <style media="screen">
        .logs-item {
            padding: 10px;
            margin: -3px 0;
            transition: all 0.2s;
        }
        .logs-item:hover {
            background: rgb(241, 241, 241);
            color: rgb(0, 0, 0);
            border-radius: 5px;
        }
    </style>
    <body>



        <?php require_once $path->layouts . '/panel.php'; ?>
        <?php require_once $path->layouts . '/notice.php'; ?>



        <div id="parent">
            <div id="child">
                <div id="log-box" class="add-box">
                    <div id="log-box-inner">
                        <h3>Logs</h3>
                        <hr>
                        <div id="logs-box" value="<?php echo $uri->all_logs; ?>">
                            <p><small>Loading logs... Please wait...</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <?php require_once $path->layouts . '/footer.php'; ?>



    </body>
    <script type="text/javascript">
        Petis('#logs-box').load(Petis('#logs-box').attr('value') + '?identifier=logs');

        // Confirm delete all
        Petis('.content-delete-confirm-all').on('click', function(e)
        {
            e.preventDefault();

            var index = Petis(this).attr('valIndex');
                id = Petis(this).attr('valId');

            ajax(Petis(this).attr('valUrl'), 'id=' + id, 'All ' + index.toLowerCase() + 's' +
                ' have been deleted succesfully!', false, false, function()
                {
                    Petis('#content-layout').inner('<i>Logs was cleaned.</i>');
                });
        });

        // Pagination
        pagination(Petis('#logs-box').attr('value'), '#logs-box');
    </script>
</html>
