<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex,nofollow,nosnippet,noodp,noarchive,noimageindex,none">
        <meta name="googlebot" content="noindex,nofollow,nosnippet,noodp,noarchive,noimageindex,none">
        <title>Login</title>
        <link href="https://fonts.googleapis.com/css?family=Lato|Roboto" rel="stylesheet">
        <link rel="stylesheet" href="<?= $adminAssets . '/stylesheets/lodeh.0.0.1.css'; ?>" media="screen" title="no title" charset="utf-8">
        <script src="<?= $adminAssets . '/scripts/jquery.js'; ?>"></script>
        <script src="<?= $adminAssets . '/scripts/functions.js'; ?>"></script>
        <script src="<?php echo $adminAssets.'/scripts/documentProperties.js';?>"></script>
        <script src="<?php echo $adminAssets.'/scripts/functions.js';?>"></script>
        <style media="screen">
            #content {margin:2% 0 4%;}
        </style>
    </head>
    <body class="L-b-whitesmoke">
        <div id="parent">
            <div id="header" class="L-t-a-right L-width-100">
                <div id="header-inner" class="L-padding-30px L-g-f-lato L-font-16px">
                    <span class="L-padding-20px"><a class="L-c-blacksmoke L-a-style-1" href="/">Homepage</a></span>
                </div>
            </div>
            <div id="content" class="L-h-style-1">
                <div id="content-inner" class="L-padding-5">
                    <div class="L-d-flex">
                        <div class="L-width-100 L-padding-2 L-t-a-left L-d-flex">
                            <div class="L-width-400px L-m-auto">
                                <h3 class="L-c-blacksmooth L-g-f-roboto">Login to backend</h3>
                                <form id="login-form">
                                    <div class="L-d-flex" style="margin-bottom:-10px">
                                        <input class="L-i-style-1-l L-width-100" type="text" name="<?= md5('name'); ?>" placeholder="Enter email or username">
                                    </div>
                                    <div class="L-d-flex">
                                        <input class="L-i-style-1-l L-width-100" type="password" name="<?= md5('password'); ?>" placeholder="Enter password">
                                    </div>
                                </form>
                                <button id="login-button" class="L-b-style-1-l L-width-100" type="button" name="button">Login</button>
                                <div class="L-width-100 L-o-auto L-p-relative L-bottom">
                                    <p id="alert" class="L-d-none L-n-style-1-danger L-t-a-center"></p>
                                </div>
                                <br><br>
                                <div class="L-t-a-center">
                                    <span class="L-c-blacksmoke L-font-12px L-g-f-roboto"><?= $footerTagline ?></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input id="index-dashboard" type="hidden" value="<?= $dashboard; ?>">
    </body>
    <script>
        $(window).load(function()
        {
            var properties = documentProperties();
            var indexDashboard = $('#index-dashboard').val();
            properties.objectContent.indexUrl = indexDashboard + '/process/validation/login';
            properties.objectContent.redirect = 'dashboard';
            properties.objectContent.alert = '#alert';
            properties.objectContent.formCreateTarget = '#login-form';
            properties.objectContent.buttonCreateTarget = '#login-button';
            properties.objectContent.notice = 'Login success';

            ajax(properties.objectAjaxProperties());
        });
    </script>
</html>
