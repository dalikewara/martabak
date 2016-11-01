<?php
    // Prepared propertes.
    $currentUri = $_SERVER['REQUEST_URI'];
    $codeMirrors = [
        $uri->create_page,
        $uri->edit_page,
        $uri->build_controller,
        $uri->edit_controller,
        $uri->add_layout,
        $uri->edit_layout,
        $uri->landing,
        $uri->home,
        $uri->construction,
    ];
    $simpleDef = [
        $uri->insert_meta,
        $uri->write_note,
        $uri->register_route,
        $uri->add_layout,
        $uri->edit_layout,
        $uri->assets_management,
        $uri->settings,
        $uri->logs,
        $uri->notes,
    ];
    $controllerDef = [
        $uri->build_controller,
        $uri->edit_controller,
    ];
    $sectionDef = [
        $uri->backend,
        $uri->create_page,
        $uri->edit_page,
    ];
    $process = [
        $uri->backend,
        $uri->notes,
        $uri->logs,
    ];
?>



<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex,nofollow,nosnippet,noodp,noarchive,noimageindex,none">
<meta name="googlebot" content="noindex,nofollow,nosnippet,noodp,noarchive,noimageindex,none">
<link rel="stylesheet" type="text/css" href="<?php echo $path->main_assets; ?>/plugins/font-awesome-4.6.3/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo $path->main_assets; ?>/stylesheets/lodeh.css">
<script src="<?php echo $path->main_assets; ?>/scripts/petis.js"></script>
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">



<?php
// Getting properties of pages that using CodeMirror.
if(in_array($currentUri, $codeMirrors)): ?>
    <script src="<?php echo $path->main_assets; ?>/plugins/CodeMirror/lib/codemirror.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo $path->main_assets; ?>/plugins/CodeMirror/lib/codemirror.css">
    <script src="<?php echo $path->main_assets; ?>/plugins/CodeMirror/addon/edit/matchbrackets.js"></script>
    <script src="<?php echo $path->main_assets; ?>/plugins/CodeMirror/mode/htmlmixed/htmlmixed.js"></script>
    <script src="<?php echo $path->main_assets; ?>/plugins/CodeMirror/mode/xml/xml.js"></script>
    <script src="<?php echo $path->main_assets; ?>/plugins/CodeMirror/mode/javascript/javascript.js"></script>
    <script src="<?php echo $path->main_assets; ?>/plugins/CodeMirror/mode/css/css.js"></script>
    <script src="<?php echo $path->main_assets; ?>/plugins/CodeMirror/mode/clike/clike.js"></script>
    <script src="<?php echo $path->main_assets; ?>/plugins/CodeMirror/mode/php/php.js"></script>
<?php endif; ?>



<style media="screen">
    html {
        height: 100%;
        box-sizing: border-box;
    }
    body {
        position: relative;
        min-height: 100%;
        font-family: "Raleway", sans-serif;
        line-height: 1.5;
        margin: 0;
        font-size: 14px;
        color: rgb(100, 100, 100);
    }
    *, *:before, *:after {
        box-sizing: inherit;
    }
    a:link {
        text-decoration: none;
        color: rgb(30, 88, 199);
    }
    a:visited {
        color: rgb(30, 88, 199);
    }
    a:hover {
        color: rgb(12, 57, 143);
        text-decoration: underline;
    }
    a:active {
        color: rgb(30, 88, 199);
    }
    #parent {
        width: 100%;
        padding: 20px 0 100px;
    }
    #child {
        width: 1000px;
        margin: auto;
        display: flex;
        padding-top: 40px;
    }
    @media only screen and (max-width: 1050px)
    {
        #child {
            width: 100%;
        }
    }
    @media only screen and (max-width: 600px)
    {
        #child {
            display: block;
            padding: 20px;
            box-sizing: border-box;
        }
    }
    @media only screen and (max-width: 400px)
    {
        #child {
            margin-top: -40px;
        }
    }



    <?php
    // Style for pages that using CodeMirror.
    if(in_array($currentUri, $codeMirrors)): ?>
        .preview-box {
            margin: -50px auto 0;
            width: 1000px;
        }
        .preview-frame {
            width: 100%;
            height: 500px;
        }
    <?php endif; ?>



    <?php
    // Style for pages that required to do process.
    if(in_array($currentUri, $process)): ?>
        .content-parent {
            border-bottom: 1px solid rgb(157, 157, 157);
        }
        .content-edit-items-text
        {
            margin-right: 10px;
            cursor: pointer;
        }
        .content-edit-items-text:hover {
            color: black;
        }
        .content-edit-items-text-delete-all {
            color: rgb(107, 107, 107);
        }
        .content-edit-items-text-delete-all:hover {
            color: rgb(255, 0, 0);
            text-decoration: underline;
        }
        .content-delete-section, .content-quick-edit-section, .content-status-section {
            display: none;
            visibility: hidden;
            margin: 8px 0;
        }
        .content-status-confirm {
            cursor: pointer;
            color: rgb(65, 138, 39);
        }
        .content-status-confirm:hover {
            color: rgb(113, 199, 83);
        }
        .content-delete-confirm, .content-delete-confirm-all {
            color: rgb(200, 48, 75);
            cursor: pointer;
        }
        .content-delete-confirm:hover, .content-delete-confirm-all:hover {
            color: rgb(255, 0, 0);
        }
        .pagination-box {
            display: block;
            clear: both;
            margin: 20px 0;
        }
        .page-index-link {
            cursor: pointer;
        }
    <?php endif; ?>



    <?php
    // Style for simple pages.
    if(in_array($currentUri, $simpleDef)): ?>
        .add-box {
            width: 450px;
            margin: 20px auto;
        }
        @media only screen and (max-width: 600px)
        {
            .add-box {
                margin: 56px auto;
            }
        }
        @media only screen and (max-width: 500px)
        {
            .add-box {
                width: 100%;
            }
        }



    <?php
    // Style for controller pages.
    elseif(in_array($currentUri, $controllerDef)): ?>
        .add-box {
            width: 800px;
            margin: 20px auto;
        }
        @media only screen and (max-width: 600px)
        {
            .add-box {
                margin: 56px auto;
            }
        }
        @media only screen and (max-width: 500px)
        {
            .add-box {
                width: 100%;
            }
        }



    <?php
    // Style for section pages.
    elseif(in_array($currentUri, $sectionDef)): ?>
        #child-inner-left {
            padding: 20px;
        }
        #child-inner-right {
            width: 100%;
            padding: 20px;
        }
        @media only screen and (max-width: 1050px)
        {
            #child-inner-left {
                width: 400px;
            }
        }
        @media only screen and (max-width: 600px)
        {
            #child-inner-left {
                width: 100%;
                margin-bottom: 40px;
                margin-top: 50px;
            }
            #child-inner-left, #child-inner-right {
                padding: 0;
                display: block;
                height: auto;
            }
        }
    <?php endif; ?>
</style>



<?php
// JavaScript for pages that required to do process.
if(in_array($currentUri, $process)): ?>
    <script type="text/javascript">
        // Display delete section
        var a = 0;

        Petis('.content-edit-items-text-delete').on('click', function()
        {
            var id = Petis(this).attr('value');

            if(a === 0)
            {
                Petis('.content-display').hide();
                Petis('#content-delete-section-' + id).show();

                a = 1;
            }
            else if(a === 1)
            {
                Petis('#content-delete-section-' + id).hide();

                a = 0;
            }
        });

        // Display quick edit section
        var b = 0;

        Petis('.content-edit-items-text-quick-edit').on('click', function()
        {
            var id = Petis(this).attr('value');

            if(b === 0)
            {
                Petis('.content-display').hide();
                Petis('#content-quick-edit-section-' + id).show();

                b = 1;
            }
            else if(b === 1)
            {
                Petis('#content-quick-edit-section-' + id).hide();

                b = 0;
            }
        });

        // Display status section
        var c = 0;

        Petis('.content-edit-items-text-status').on('click', function()
        {
            var id = Petis(this).attr('value');

            if(c === 0)
            {
                Petis('.content-display').hide();
                Petis('#content-status-section-' + id).show();

                c = 1;
            }
            else if(c === 1)
            {
                Petis('#content-status-section-' + id).hide();

                c = 0;
            }
        });

        // Pagination
        function pagination(url, parent)
        {
            Petis('.pagination').on('click', function(e)
            {
                e.preventDefault();

                var id = Petis(e.target).attr('value');
                var index = Petis(this).attr('id');
                url = (index === 'page-pagination') ? url : false;

                if(Object.prototype.toString.call(Petis(e.target).attr('value')) === '[object String]')
                {
                    Petis(parent).load(url + '?page=' + id);
                }
            });
        }
    </script>
<?php endif; ?>



<script type="text/javascript">
    // Global AJAX. Most backend pages are required AJAX.
    function ajax(url, data, msg, rm, backend, callback)
    {
        Petis({
            ajax: true,
            url: url,
            method: 'POST',
            data: data,
            complete: function(report)
            {
                Petis('#notice').show();

                if(report == 'ok')
                {
                    Petis('#notice').attr('class', 'L-notice-2-success');
                    Petis('#notice-text').inner(msg);
                    Petis('.inputs').attr('value', '');

                    if(rm !== false)
                    {
                        Petis(rm).hide();
                    }

                    if(backend)
                    {
                        Petis('#logs-box').load(Petis('#logs-box').attr('value') + '?identifier=dashboard');
                    }

                    if(Object.prototype.toString.call(callback) === '[object Function]')
                    {
                        callback();
                    }
                }
                else
                {
                    Petis('#notice').attr('class', 'L-notice-2-danger');
                    Petis('#notice-text').inner(report);
                }
            }
        });
    }
</script>
