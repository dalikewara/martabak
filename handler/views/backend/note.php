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
                        <h3>Write a new note</h3>
                        <hr>
                        <br>
                        <form id="note-form" action="<?php echo $uri->create_note; ?>">
                            <label for="">Title (40):</label>
                            <input id="input-title" class="L-input-1-s inputs" type="text" name="title" placeholder="Enter title here..." maxlength="40">
                            <label for="">Message (255):</label>
                            <textarea id="input-message" class="L-textarea-1-s inputs" name="message" rows="8" cols="40" placeholder="Enter message here..." maxlength="255"></textarea>
                            <input type="hidden" name="__token" value="token value">
                        </form>
                        <button id="add-button" class="L-button-4-s" type="button" name="button">Ok</button>
                    </div>
                </div>
            </div>
        </div>



        <?php require_once $path->layouts . '/footer.php'; ?>



    </body>
    <script type="text/javascript">
        Petis('#add-button').on('click', function()
        {
            ajax(Petis('#note-form').attr('action'), Petis('#note-form').getFormData(),
                'Note has been wrote succesfuly!');
        });
    </script>
</html>
