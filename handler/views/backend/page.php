<?php $get = isset($_GET['action']) ? $_GET['action'] : false; ?>
<!DOCTYPE html>
<html>
    <head>



        <?php require_once $path->layouts . '/metas.php'; ?>



    </head>
    <style>
        #child-inner-left {
            width: 300px;
            padding: 20px 0;
        }
        #child-inner-right {
            margin: 20px 0;
        }
        #button-preview {
            margin: 10px 0 20px;
        }
        #process-box {
            width: 100%;
        }
        .CodeMirror {
            height: 500px;
        }
        .process-button {
            margin: 5px 0;
        }
        @media only screen and (max-width: 900px)
        {
            #process-box {
                width: 210px;
            }
        }
        @media only screen and (max-width: 780px)
        {
            #process-box {
                width: 200px;
            }
        }
        @media only screen and (max-width: 660px)
        {
            #process-box {
                width: 195px;
            }
        }
        @media only screen and (max-width: 600px)
        {
            #process-box {
                position: relative;
                width: 100%;
            }
            #child-inner-left {
                width: 100%;
                padding: 0;
            }
        }
    </style>
    <body>



        <?php require_once $path->layouts . '/panel.php'; ?>
        <?php require_once $path->layouts . '/notice.php'; ?>



        <?php if($get AND ($get === 'create' OR $get === 'edit')): ?>



            <div id="parent">
                <form id="page-form" action="<?php echo ($get === 'edit') ? $uri->edit_page_c : $uri->create_page_c; ?>">
                    <div id="child">
                        <div id="child-inner-left">
                            <div class="child-section">
                                <div id="process-box">
                                    <?php if($get === 'edit'): ?>
                                        <h3>Edit page</h3>
                                    <?php else: ?>
                                        <h3>Create new page</h3>
                                    <?php endif; ?>
                                    <hr>
                                    <br>
                                    <label for="">Title (40):</label>
                                    <input id="page-title" class="L-input-1-s inputs" type="text" name="title" placeholder="Enter title here..." maxlength="40">
                                    <label for="">Slug (80):</label>
                                    <input id="page-slug" class="L-input-1-s inputs" type="text" name="slug" placeholder="Enter slug here..." maxlength="80">
                                    <label for="">Description (255):</label>
                                    <textarea id="page-desc" class="L-textarea-1-s inputs" rows="11" type="text" name="desc" placeholder="Enter description here..." maxlength="255"></textarea>
                                    <?php if($get === 'edit'): ?>
                                        <button id="page-button-update" class="L-button-1-s process-button" type="button" name="button">Update</button>
                                        <button id="page-button-draft" class="L-button-1-s process-button" type="button" name="button">Draft</button>
                                        <button id="page-button-publish" class="L-button-4-s process-button" type="button" name="button">Publish</button>
                                    <?php else: ?>
                                        <button id="page-button-draft" class="L-button-1-s process-button" type="button" name="button">Draft</button>
                                        <button id="page-button-publish" class="L-button-4-s process-button" type="button" name="button">Publish</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div id="child-inner-right">
                            <div class="child-section">
                                <textarea id="code" class="L-textarea-1-s inputs" name="content" placeholder="Enter note message here...">// Write your code here...</textarea>
                                <button id="button-preview" class="L-button-3-s" type="button" name="button" value="<?php echo $uri->custom_preview; ?>">Preview</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="preview-box">
                    <iframe class="L-box-1 preview-frame" src="<?php echo $uri->preview; ?>"></iframe>
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
        Petis('#button-preview').on('click', function()
        {
            Petis('.preview-frame').attr('src', Petis(this).attr('value') + '?data='
                + Petis({encode: editor.getValue()}));
        });

        // Publish confirm
        Petis('#page-button-publish').on('click', function()
        {
            ajax(Petis('#page-form').attr('action'), 'title=' + Petis({encode:
                Petis('#page-title').val}) + '&content=' +
                Petis({encode: editor.getValue()}) + '&slug=' + Petis({encode:
                    Petis('#page-slug').val}) + '&status=1' + '&desc=' + Petis({
                    encode: Petis('#page-desc').val}) + '&__token=',
                'Page has been created succesfuly!');
        });

        // Draft confirm
        Petis('#page-button-draft').on('click', function()
        {
            ajax(Petis('#page-form').attr('action'), 'title=' + Petis({encode:
                Petis('#page-title').val}) + '&content=' +
                Petis({encode: editor.getValue()}) + '&slug=' + Petis({encode:
                    Petis('#page-slug').val}) + '&status=2' + '&desc=' + Petis({
                    encode: Petis('#page-desc').val}) + '&__token=',
                'Page has been saved succesfuly as draft!');
        });
    </script>
</html>
