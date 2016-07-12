<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex,nofollow,nosnippet,noodp,noarchive,noimageindex,none">
        <meta name="googlebot" content="noindex,nofollow,nosnippet,noodp,noarchive,noimageindex,none">
        <title>Martabak Installation</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <style media="screen">
            body{
                margin: 0;
                background: rgb(219, 219, 219);
            }

            h1{
                margin: 0;
            }

            #header{
                background: rgb(131, 75, 24);
                text-align: center;
                padding: 20px 0;
            }

            #header-title{
                color: rgb(36, 18, 1);
            }

            #header-slug{
                font-size: 12px;
            }

            #panel{
                padding: 10px 0;
                background: rgb(107, 56, 10);
                text-align: center;
            }

            #content{
                color: rgb(54, 54, 54);
                background: rgb(255, 255, 255);
                padding: 20px 0 40px;
            }

            #footer{
                text-align: center;
                font-size: 12px;
                color: rgb(167, 167, 167);
                background: rgb(255, 255, 255);
                padding: 10px 0;
            }

            .child-layout{
                width: 60%;
                margin: auto;
            }

            .content-layout{

            }

            .content-title{
                text-align: center;
            }

            .content-body{
              padding: 20px;
            }

            .content-button{
                text-align: right;
            }

            .unactive{
                pointer-events: none;
                opacity: 0.5;
            }

            .focus{
                color: rgb(173, 173, 173);
                font-size: 16px
                pointer-events: none;
            }

            .unfocus{
                pointer-events: none;
                color: rgb(79, 42, 7);
                font-size: 14px
            }

            .none{
                display: none;
            }

            .green{
                color: green;
            }

            .red{
                color: red;
            }
        </style>
    </head>
    <body>
        <div id="main-layout" class="parent-layout">
            <div id="header" class="child-layout">
                <h1 id="header-title">Martabak</h1>
                <small id="header-slug"><i>The Website Manager</i></small>
            </div>
            <div id="panel" class="child-layout">
                <span id="panel-requirements" class="focus" value="active">Requirements</span>
                <span id="panel-database" class="unfocus" value="unactive">Database & Server</span>
                <span id="panel-account" class="unfocus" value="unactive">Account</span>
                <span id="panel-done" class="unfocus" value="unactive">Done!</span>
            </div>
            <div id="content" class="child-layout">
                <div id="content-parent" class="content-layout">
                    <div class="content-title">
                        <div id="title-requirements">
                            <span>
                                Martabak needs some requirements from your server or web hosting.
                                Please make sure your server meets the requirements to can be run perfectly.
                            </span>
                        </div>
                    </div>
                    <div class="content-body">
                        <form>
                            <div id="content-requirements">
                                <ul>
                                    <li>
                                        PHP version 5.5.9 or higher
                                        <?php
                                          if(phpversion() < '5.5.9' OR PHP_VERSION < '5.5.9')
                                          {
                                              echo '<span id="re-ver" class="red" value="not-ok">*</span>';
                                          }
                                          else
                                          {
                                              echo '<span id="re-ver" class="green" value="ok">*</span>';
                                          }
                                        ?>
                                    </li>
                                    <li>
                                        PDO PHP Extension
                                        <?php
                                            if(defined('PDO::ATTR_DRIVER_NAME')) {
                                                echo '<span id="re-pdo" class="green" value="ok">*</span>';
                                            }
                                            else
                                            {
                                                echo '<span id="re-pdo" class="red" value="not-ok">*</span>';
                                            }
                                        ?>
                                    </li>
                                    <li>
                                        Mbstring PHP Library
                                        <?php
                                            if(extension_loaded('mbstring'))
                                            {
                                                echo '<span id="re-mbs" class="green" value="ok">*</span>';
                                            }
                                            else
                                            {
                                                echo '<span id="re-mbs" class="red" value="not-ok">*</span>';
                                            }
                                        ?>
                                    </li>
                                    <li>
                                        Tokenizer PHP Extension
                                        <?php
                                            if(extension_loaded('tokenizer'))
                                            {
                                                echo '<span id="re-tok" class="green" value="ok">*</span>';
                                            }
                                            else
                                            {
                                                echo '<span id="re-tok" class="red" value="not-ok">*</span>';
                                            }
                                        ?>
                                    </li>
                                    <li>
                                        OpenSSL PHP Extension
                                        <?php
                                            if(extension_loaded('openssl'))
                                            {
                                                echo '<span id="re-ope" class="green" value="ok">*</span>';
                                            }
                                            else
                                            {
                                                echo '<span id="re-ope" class="red" value="not-ok">*</span>';
                                            }
                                        ?>
                                    </li>
                                </ul>
                            </div>
                            <div id="content-database" class="none">
                                <input type="hidden" name="type" value="database">
                                <label for="">Host:</label>
                                <input type="text" name="db-host">
                                <br><br>
                                <label for="">Database Name:</label>
                                <input type="text" name="db-name">
                                <br><br>
                                <label for="">Database Connection:</label>
                                <input type="text" name="db-connection" value="mysql">
                                <br><small>Default is "mysql"</small><br><br>
                                <label for="">Username:</label>
                                <input type="text" name="db-username">
                                <br><br>
                                <label for="">Password:</label>
                                <input type="text" name="db-password">
                            </div>
                        </form>
                        <div class="content-button">
                            <button class="button-back unactive" type="button" name="button">Back</button>
                            <button class="button-next unactive" type="button" name="button">Next</button>
                            <button class="button-check unactive" type="button" name="button">Check</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="footer" class="child-layout">
                Martabak <i>The Website Manager</i> <br> trademark by Dali Kewara
            </div>
        </div>
        <span id="success" style="display:none">success</span>
    </body>
    <script type="text/javascript">
        $(window).load(function()
        {
            $('.button-next').addClass('unactive');
            $('.button-back').fadeOut('unactive');
            $('.button-check').fadeOut('unactive');

            var reVer = $('#re-ver').attr('value');
            var rePdo = $('#re-pdo').attr('value');
            var reMbs = $('#re-mbs').attr('value');
            var reTok = $('#re-tok').attr('value');
            var reOpe = $('#re-ope').attr('value');

            if(reVer == 'ok' && rePdo == 'ok' && reMbs == 'ok' && reTok == 'ok' && reOpe == 'ok')
            {
                $('.button-next').removeClass('unactive').attr('id', 'requirements-next');
            }

            $(document).on('click', '#requirements-next', function()
            {
                $('#content-requirements, #title-requirements').fadeOut(function()
                {
                    $('.button-next').fadeOut();
                    $('.button-check').fadeIn().removeClass('unactive').attr('id', 'database-check');;
                    $('.button-back').fadeIn().removeClass('unactive').attr('id', 'database-back');
                    $('#panel-requirements').removeClass('focus').addClass('unfocus');
                    $('#panel-database').removeClass('unfocus').addClass('focus');
                    $('#content-database').fadeIn();
                });
            });

            $(document).on('click', '#database-check', function()
            {
                var data = $('form').serialize();

                ajax(data);
            });

            $(document).on('click', '#database-back', function()
            {
                $('#content-database').fadeOut(function()
                {
                    $('.button-next').fadeIn();
                    $('.button-check').fadeOut();
                    $('.button-back').fadeOut().addClass('unactive').attr('id', '');
                    $('#panel-requirements').addClass('focus').removeClass('unfocus');
                    $('#panel-database').addClass('unfocus').removeClass('focus');
                    $('#content-requirements, #title-requirements').fadeIn();
                });
            });

            $(document).on('click', '#database-next', function()
            {

            });

            $(document).on('click', '#account-back', function()
            {

            });

            $(document).on('click', '#account-next', function()
            {

            });

            function ajax(data)
            {
                console.log(data);

                $.ajax
                ({
                    url: 'data-install.php',
                    type: 'POST',
                    data: data,
                    success: function(report)
                    {
                        if(report == 'success')
                        {
                            $('#success').fadeIn();
                        }
                    },
                    error: function()
                    {

                    }
                });
            }
        });
    </script>
</html>
