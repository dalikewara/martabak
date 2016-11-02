<!DOCTYPE html>
<html>
    <head>



        <?php require_once$path->layouts . '/metas.php'; ?>



    </head>
    <style media="screen">
    </style>
    <body>



        <?php require_once$path->layouts . '/panel.php'; ?>
        <?php require_once$path->layouts . '/notice.php'; ?>



        <div id="parent">
            <div id="child">
                <div id="route-box" class="add-box">
                    <div id="route-box-inner">
                        <h3>Register a new route</h3>
                        <hr>
                        <br>
                        <form id="route-form" action="<?php echo $uri->create_route; ?>" method="POST">
                            <label for="">Prefix (20):</label>
                            <input class="L-input-1-s inputs" type="text" name="prefix" placeholder="Enter prefix here..." maxlength="20">
                            <label for="">Uri (80):</label>
                            <input class="L-input-1-s inputs" type="text" name="uri" placeholder="Enter uri here..." maxlength="80">
                            <label for="">Method: </label>
                            <br>
                            <input type="radio" name="method" value="GET" checked> GET
                            <input type="radio" name="method" value="POST"> POST
                            <br><br>
                            <label for="">Target (255):</label>
                            <input class="L-input-1-s inputs" type="text" name="target" placeholder="Enter target here..." maxlength="255">
                        </form>
                        <button id="route-button" class="L-button-4-s" type="button" name="button">Register route</button>
                    </div>
                </div>
            </div>
        </div>



        <?php require_once$path->layouts . '/footer.php'; ?>



    </body>
    <script type="text/javascript">
        Petis('#route-button').on('click', function()
        {
            ajax(Petis('#route-form').attr('action'), Petis('#route-form').getFormData(),
                'Route has been registered succesfuly!');
        });
    </script>
</html>
