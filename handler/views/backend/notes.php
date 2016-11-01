<!DOCTYPE html>
<html>
    <head>



        <?php require_once $path->layouts . '/metas.php'; ?>



    </head>
    <body>



        <?php require_once $path->layouts . '/panel.php'; ?>
        <?php require_once $path->layouts . '/notice.php'; ?>



        <div id="parent">
            <div id="child">
                <div id="note-box" class="add-box">
                    <div id="note-box-inner">
                        <h3>Notes</h3>
                        <hr>
                        <div id="notes-box" value="<?php echo $uri->all_notes; ?>">
                            <p><small>Loading notes... Please wait...</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <?php require_once $path->layouts . '/footer.php'; ?>



    </body>
    <script type="text/javascript">
        Petis('#notes-box').load(Petis('#notes-box').attr('value'));

        // Confirm delete
        Petis('.content-delete-confirm').on('click', function(e)
        {
            e.preventDefault();

            var index = Petis(this).attr('valIndex');
                id = Petis(this).attr('valId');

            ajax(Petis(this).attr('valUrl'), 'id=' + id + '&title=' + Petis(this).attr('valTitle'),
            index + ' has been deleted succesfully!', '#' + index.toLowerCase() + '-' + id);
        });

        // Confirm delete all
        Petis('.content-delete-confirm-all').on('click', function(e)
        {
            e.preventDefault();

            var index = Petis(this).attr('valIndex');
                id = Petis(this).attr('valId');

            ajax(Petis(this).attr('valUrl'), 'id=' + id, 'All ' + index.toLowerCase() + 's' +
                ' have been deleted succesfully!', false, false, function()
                {
                    Petis('#content-layout').inner('<i>Notes was cleaned.</i>');
                });
        });

        // Save edit
        Petis('.content-quick-edit-confirm').on('click', function(e)
        {
            e.preventDefault();

            var id = Petis(this).attr('valId');

            ajax(Petis(this).attr('valUrl'), Petis('#content-quick-edit-form-'
                + id).getFormData(), index = Petis(this).attr(
                'valIndex') + ' has been edited succesfully!', false, false, function()
                {
                    Petis('#content-main-title-' + id).inner(Petis(
                        '#content-quick-edit-input-title-' + id).val);
                    Petis('#content-main-message-' + id).inner(Petis(
                        '#content-quick-edit-input-textarea-' + id).val);
                    Petis('#content-main-last-edited-' + id).inner('Last edited: recent');
                });
        });

        // Pagination
        pagination(Petis('#notes-box').attr('value'), '#notes-box');
    </script>
</html>
