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
        #preview-frame {
            width: 100%;
            height: 500px;
        }
        #landing-menu {
            margin: 20px 0 20px;
        }
        #landing-title {
            width: 100%;
            margin: 10px 0 2px;
            text-align: center;
            padding: 2px 0;
        }
        #preview-button {
            margin: 0 0 20px;
        }
        #landing-loading-text {
            text-align: center;
            margin: 20px auto;
            display: none;
            visibility: hidden;
        }
        .CodeMirror {
            height: 500px;
            margin: 0 0 20px;
        }
        .menu-title {
            cursor: pointer;
        }
    </style>
    <body>



        <?php require_once $path->layouts . '/panel.php'; ?>
        <?php require_once $path->layouts . '/notice.php'; ?>



        <?php if(!$get OR in_array($get, $landings)): ?>
            <div id="parent">
                <div id="child">
                    <div id="child-inner">
                        <div id="landing-menu">
                            <span><small>Edit:</small></span>
                            <span id="landing-index-home" class="landing-index menu-title"><a href="<?php echo $uri->landing; ?>">Home</a></span> |
                            <span id="landing-index-construction" class="landing-index menu-title"><a href="<?php echo $uri->landing_construction; ?>">Construction</a></span>
                        </div>
                        <?php if($get === 'homepage-landing'): ?>
                            <div id="landing-title" class="L-box-1"><span id="landing-title-text">Customize your Homepage</span></div>
                        <?php elseif($get === 'construction-landing'): ?>
                            <div id="landing-title" class="L-box-1"><span id="landing-title-text">Customize your Construction Page</span></div>
                        <?php endif; ?>



                        <?php require_once $path->layouts . '/toolkit.php'; ?>



                        <textarea id="code" name="name" cols="10" rows="20"><?php echo $data; ?></textarea>
                        <div id="landing-loading-parent">
                            <div id="landing-loading-child"></div>
                            <div id="landing-loading-text">
                                <p>Loading content... Please wait...</p>
                            </div>
                        </div>
                        <button id="preview-button" class="L-button-3-s" value="<?php echo $uri->custom_preview; ?>"><i class="fa fa-eye" aria-hidden="true"></i> Save changes</button>
                        <button id="preview-button" class="L-button-3-s" value="<?php echo $uri->custom_preview; ?>"><i class="fa fa-eye" aria-hidden="true"></i> Preview</button>
                        <iframe id="preview-frame" class="L-box-1" src="<?php echo $uri->preview; ?>"></iframe>
                    </div>
                </div>
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

        // Preview
        Petis('#preview-button').on('click', function()
        {
            Petis('#preview-frame').attr('src', Petis(this).attr('value') + '?data='
                + Petis({encode: editor.getValue()}));
        });
    </script>
</html>
