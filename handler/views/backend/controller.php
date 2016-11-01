<?php $get = isset($_GET['action']) ? $_GET['action'] : false; ?>
<!DOCTYPE html>
<html>
    <head>



        <?php require_once $path->layouts . '/metas.php'; ?>



    </head>
    <style media="screen">
        #comment {
            margin: 10px 0;
        }
    </style>
    <body>



        <?php require_once $path->layouts . '/panel.php'; ?>
        <?php require_once $path->layouts . '/notice.php'; ?>



        <?php if($get AND ($get === 'build' OR $get === 'edit')): ?>
            <div id="parent">
                <div id="child">
                    <div id="controller-box" class="add-box">
                        <div id="controller-box-inner">
                            <?php if($get === 'edit'): ?>
                                <h3>Edit controller</h3>
                            <?php else: ?>
                                <h3>Build new controller</h3>
                            <?php endif; ?>
                            <hr>
                            <br>
                            <form id="controller-form" action="<?php echo ($get === 'edit') ? $uri->edit_controller : $uri->create_controller; ?>">
                                <label for="">Controller name (40):</label>
                                <input id="controller-name" class="L-input-1-s inputs" type="text" name="name" placeholder="Enter name here..." maxlength="40">
                                <textarea id="code" class="L-textarea-1-s inputs" name="content">// Write your code here...</textarea>
                                <textarea id="controller-comment" class="L-textarea-1-s inputs" name="comment" rows="4" placeholder="/* Enter comment here... (255) */" maxlength="255"></textarea>
                            </form>
                            <?php if($get === 'edit'): ?>
                                <button id="controller-button" class="L-button-4-s" type="button" name="button">Update</button>
                            <?php else: ?>
                                <button id="controller-button" class="L-button-4-s" type="button" name="button">Build</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>




        <?php else: ?>
            <?php require_once $path->layouts . '/null.php'; ?>
        <?php endif; ?>
        <?php require_once $path->layouts . '/footer.php'; ?>
    </body>
    <script type="text/javascript">
        var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
          lineNumbers: true,
          matchBrackets: true,
          mode: "application/x-httpd-php",
          indentUnit: 4,
          indentWithTabs: true
        });

        Petis('#controller-button').on('click', function()
        {
            ajax(Petis('#controller-form').attr('action'), 'name=' + Petis({encode:
                Petis('#controller-name').val}) + '&content=' +
                Petis({encode: editor.getValue()}) + '&comment=' + Petis({encode:
                    Petis('#controller-comment').val}) + '&__token=',
                'Controller has been built succesfuly!');
        });
    </script>
</html>
