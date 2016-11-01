<?php $get = isset($_GET['action']) ? $_GET['action'] : false; ?>
<!DOCTYPE html>
<html>
    <head>
        <?php require_once $paths->get('layouts') . '/metas.php'; ?>
    </head>
    <style media="screen">
        #layout-button {
            margin: 20px 0;
        }
    </style>
    <body>
        <?php require_once $paths->get('layouts') . '/panel.php'; ?>
        <?php require_once $paths->get('layouts') . '/notice.php'; ?>
        <?php if($get AND ($get === 'add' OR $get === 'edit')): ?>
            <div id="parent">
                <div id="child">
                    <div id="layout-box" class="add-box">
                        <div id="layout-box-inner">
                            <?php if($get === 'edit'): ?>
                                <h3>Edit layout</h3>
                            <?php else: ?>
                                <h3>Add a new layout</h3>
                            <?php endif; ?>
                            <hr>
                            <br>
                            <form id="layout-form" action="<?php echo ($get === 'edit') ? $uris->get('edit-layout') : $uris->get('create-layout'); ?>">
                                <label for="">Name (40):</label>
                                <input id="layout-name" class="L-input-1-s inputs" type="text" name="name" placeholder="Enter layout name here..." maxlength="40">
                                <textarea id="code" class="L-textarea-1-s inputs" name="content" placeholder="Enter note message here...">Write your code here...</textarea>
                            </form>
                            <?php if($get === 'edit'): ?>
                                <button id="layout-button" class="L-button-4-s button" type="button" name="button">Update</button>
                            <?php else: ?>
                                <button id="layout-button" class="L-button-4-s button" type="button" name="button">Add layout</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <?php require_once $paths->get('layouts') . '/null.php'; ?>
        <?php endif; ?>
        <?php require_once $paths->get('layouts') . '/footer.php'; ?>
    </body>
    <script type="text/javascript">
        var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
          lineNumbers: true,
          matchBrackets: true,
          mode: "application/x-httpd-php",
          indentUnit: 4,
          indentWithTabs: true
        });

        Petis('#layout-button').on('click', function()
        {
            ajax(Petis('#layout-form').attr('action'), 'name=' + Petis({encode:
                Petis('#layout-name').val}) + '&content=' +
                Petis({encode: editor.getValue()}) + '&__token=',
                'Layout has been added succesfuly!');
        });
    </script>
</html>
