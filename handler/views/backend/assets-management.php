<?php $get = isset($_GET['action']) ? $_GET['action'] : false; ?>
<!DOCTYPE html>
<html>
    <head>
        <?php require_once $paths->get('layouts') . '/metas.php'; ?>
    </head>
    <style media="screen">
        #button {
            margin: 20px 0;
        }
        #asset-box-section-heading {
            background: rgb(240, 240, 240);
            height: 25px;
        }
        .add-box {
            width: 800px;
        }
        .asset-box-section {
            display: flex;
            overflow: hidden;
        }
        .asset-box-section-inner-val {
            margin-bottom: -20px;
            overflow: auto;
            padding: 20px;
        }
        .asset-box-section-inner {
            width: 100%;
        }
    </style>
    <body>
        <?php require_once $paths->get('layouts') . '/panel.php'; ?>
        <?php require_once $paths->get('layouts') . '/notice.php'; ?>
        <div id="parent">
            <div id="child">
                <div id="layout-box" class="add-box">
                    <div id="layout-box-inner">
                        <h3>Manage your assets</h3>
                        <hr>
                        <div class="">
                            <p>/ stylesheets / lodeh</p>
                        </div>
                        <div id="asset-box" class="">
                            <div id="asset-box-inner" class="">
                                <div id="asset-box-section-heading" class="asset-box-section L-box-1">
                                    <div class="asset-box-section-inner">
                                        <span>File name</span>
                                    </div>
                                    <div class="asset-box-section-inner">
                                        <span>Size</span>
                                    </div>
                                    <div class="asset-box-section-inner">
                                        <span>Link</span>
                                    </div>
                                    <div class="asset-box-section-inner">
                                        <span>Modified</span>
                                    </div>
                                </div>
                                <?php for($i = 0; $i < 10; $i++): ?>
                                    <div class="asset-box-section">
                                        <div class="asset-box-section-inner asset-box-section-inner-val">
                                            <p>valekhtjejkbnkjnknklnknkj.jpg</p>
                                        </div>
                                        <div class="asset-box-section-inner asset-box-section-inner-val">
                                            <p>/assets/user/img.jpg<p>
                                        </div>
                                        <div class="asset-box-section-inner asset-box-section-inner-val">
                                            <p>val</p>
                                        </div>
                                        <div class="asset-box-section-inner asset-box-section-inner-val">
                                            <p>val</p>
                                        </div>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript">
        var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
          lineNumbers: true,
          matchBrackets: true,
          mode: "application/x-httpd-php",
          indentUnit: 4,
          indentWithTabs: true
        });
    </script>
</html>
