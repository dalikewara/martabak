<?php $get = isset($_GET['template']) ? $_GET['template'] : false; ?>
<!DOCTYPE html>
<html>
    <head>



        <?php require_once $path->layouts . '/metas.php'; ?>



    </head>
    <style>
        #child-inner {
            width: 100%;
        }
        #preview {
            width: 100%;
            height: 500px;
        }
        #landing-menu {
            margin: 20px 0 5px;
        }
        .CodeMirror {
            height: 500px;
            margin: 0 0 20px;
        }
        .menu-title {
            cursor: pointer;
        }
        .edit-active {
            font-weight: bold;
        }
    </style>
    <body>



        <?php require_once $path->layouts . '/panel.php'; ?>
        <?php require_once $path->layouts . '/notice.php'; ?>



        <?php if(!$get OR $get === 'home' OR $get === 'construction'): ?>
            <div id="parent">
                <div id="child">
                    <div id="child-inner">
                        <div id="landing-menu">
                            <span><small>Edit:</small></span>
                            <span class="menu-title edit-active">Home</span> |
                            <span class="menu-title">Construction</span>
                        </div>
                        <textarea id="code" name="name" cols="10" rows="20"></textarea>
                        <iframe id="preview" class="L-box-1" src="/"></iframe>
                    </div>
                </div>
                <!-- <form>
                    <div id="child">
                        <div id="child-inner-left">
                            <div class="child-section">
                                <div id="process-box">
                                    <h3>Landing pages</h3>
                                    <hr>
                                    <p>Home</p>
                                    <p>Construction</p>
                                </div>
                            </div>
                        </div>
                        <div id="child-inner-right">
                            <div class="child-section">
                                <textarea id="code" class="L-textarea-1-s" name="note-message" placeholder="Enter note message here...">// Write your code here...</textarea>
                                <button id="button-run" class="L-button-3-s" type="button" name="button">Preview</button>
                                <br>
                                <iframe id="preview-box" class="L-box-1" src=""></iframe>
                            </div>
                        </div>
                    </div>
                </form> -->
            </div>



        <?php else: ?>
            <?php require_once $path->layouts . '/null.php'; ?>
        <?php endif; ?>
        <?php require_once $path->layouts . '/footer.php'; ?>
    </body>
    <script>
        var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
          lineNumbers: true,
          matchBrackets: true,
          mode: "application/x-httpd-php",
          indentUnit: 4,
          indentWithTabs: true
        });
    </script>
</html>
