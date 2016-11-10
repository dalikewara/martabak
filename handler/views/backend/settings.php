<!DOCTYPE html>
<html>
    <head>



        <?php require_once $path->layouts . '/metas.php'; ?>



    </head>
    <style media="screen">
        .group-items {
            margin-bottom: 10px;
            background: rgb(247, 247, 247);
        }
        .group-items-inner {
            padding: 10px;
        }
    </style>
    <body>



        <?php require_once $path->layouts . '/panel.php'; ?>
        <?php require_once $path->layouts . '/notice.php'; ?>



        <div id="parent">
            <div id="child">
                <div id="settings-box" class="add-box">
                    <div id="settings-box-inner">
                        <h3>Settings for backend</h3>
                        <hr>
                        <br>
                        <p id="system-route-setting" url="<?php echo $uri->edit_route; ?>"><strong>System routes.</strong></p>
                        <div class="group-items L-box-1">
                            <div class="group-items-inner">
                                <form id="form-system-route-backend" class="">
                                    <label for="">Backend route:</label>
                                    <input id="input-system-route-uri-backend" class="L-input-1-s" type="text" name="uri" value="<?php echo $uri->backend; ?>" placeholder="Enter uri for backend...">
                                    <input type="hidden" name="prefix" value="backend">
                                    <input type="hidden" name="target" value="null">
                                    <input type="hidden" name="method" value="GET">
                                    <input type="hidden" name="system" value="1">
                                    <input type="hidden" name="id" value="1">
                                    <input type="hidden" name="__token" value="1">
                                </form>
                                <button class="system-routes-setting-button L-button-1-s" type="button" name="button" routeName="backend">Change backend</button>
                            </div>
                        </div>
                        <div class="group-items L-box-1">
                            <div class="group-items-inner">
                                <form id="form-system-route-login" class="">
                                    <label for="">Log in route:</label>
                                    <input id="input-system-route-uri-login" class="L-input-1-s" type="text" name="uri" value="<?php echo $uri->login; ?>" placeholder="Enter uri for log in...">
                                    <input type="hidden" name="prefix" value="login">
                                    <input type="hidden" name="target" value="null">
                                    <input type="hidden" name="method" value="GET">
                                    <input type="hidden" name="system" value="1">
                                    <input type="hidden" name="id" value="2">
                                    <input type="hidden" name="__token" value="1">
                                </form>
                                <button class="system-routes-setting-button L-button-1-s" type="button" name="button" routeName="login">Change log in</button>
                            </div>
                        </div>
                        <div class="group-items L-box-1">
                            <div class="group-items-inner">
                                <form id="form-system-route-logout" class="">
                                    <label for="">Log out route:</label>
                                    <input id="input-system-route-uri-logout" class="L-input-1-s" type="text" name="uri" value="<?php echo $uri->logout; ?>" placeholder="Enter uri for log out...">
                                    <input type="hidden" name="prefix" value="logout">
                                    <input type="hidden" name="target" value="null">
                                    <input type="hidden" name="method" value="GET">
                                    <input type="hidden" name="system" value="1">
                                    <input type="hidden" name="id" value="3">
                                    <input type="hidden" name="__token" value="1">
                                </form>
                                <button class="system-routes-setting-button L-button-1-s" type="button" name="button" routeName="logout">Change log out</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>



        <?php require_once $path->layouts . '/footer.php'; ?>



    </body>
    <script type="text/javascript">
        Petis('.system-routes-setting-button').on('click', function()
        {
            var name = Petis(this).attr('routeName');

            ajax(Petis('#system-route-setting').attr('url'), Petis('#form-system-route-' + name).getFormData(),
                'Route or url for ' + name + ' has changed to ' + Petis('#input-system-route-uri-' + name).val +
                '. <a href="' + Petis('#input-system-route-uri-backend').val + '/settings">Click here to complete</a>.');
        });
    </script>
</html>
