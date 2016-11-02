<!DOCTYPE html>
<html>
    <head>



        <?php require_once $path->layouts . '/metas.php'; ?>



    </head>
    <style media="screen">

    </style>
    <body>



        <?php require_once $path->layouts . '/panel.php'; ?>
        <?php require_once $path->layouts . '/notice.php'; ?>



        <div id="parent">
            <div id="child">
                <div id="note-box" class="add-box">
                    <div id="note-box-inner">
                        <h3>Insert a new custom meta</h3>
                        <hr>
                        <br>
                        <form id="meta-form" action="<?php echo $uri->create_meta; ?>">
                            <label for="">custom_id (11 | int):</label>
                            <input class="L-input-1-s inputs" type="text" name="custom_id" placeholder="Enter custom_id here..." maxlength="11">
                            <label for="">type (20 | varchar):</label>
                            <input class="L-input-1-s inputs" type="text" name="type" placeholder="Enter type here..." maxlength="20">
                            <label for="">name (20 | varchar):</label>
                            <input class="L-input-1-s inputs" type="text" name="name" placeholder="Enter name here..." maxlength="20">
                            <label for="">value1 (255 | varchar):</label>
                            <input class="L-input-1-s inputs" type="text" name="value1" placeholder="Enter value1 here..." maxlength="255">
                            <label for="">value2 (255 | varchar):</label>
                            <input class="L-input-1-s inputs" type="text" name="value2" placeholder="Enter value2 here..." maxlength="255">
                            <label for="">value3 (11 | int):</label>
                            <input class="L-input-1-s inputs" type="text" name="value3" placeholder="Enter value3 here..." maxlength="11">
                            <label for="">value4 (text):</label>
                            <textarea class="L-textarea-1-s inputs" name="value4" rows="8" cols="40" placeholder="Enter value4 here..."></textarea>
                            <label for="">value5 (longtext):</label>
                            <textarea class="L-textarea-1-s inputs" name="value5" rows="8" cols="40" placeholder="Enter value5 here..."></textarea>
                            <label for="">value6 (timestamp):</label>
                            <input class="L-input-1-s inputs" type="text" name="value6" placeholder="Enter value6 here...">
                            <input type="hidden" name="__token" value="token value">
                        </form>
                        <button id="insert-button" class="L-button-4-s" type="button" name="button">Insert meta</button>
                    </div>
                </div>
            </div>
        </div>



        <?php require_once $path->layouts . '/footer.php'; ?>



    </body>
    <script type="text/javascript">
    Petis('#insert-button').on('click', function()
    {
        ajax(Petis('#meta-form').attr('action'), Petis('#meta-form').getFormData(),
            'Meta has been inserted succesfuly!');
    });
    </script>
</html>
