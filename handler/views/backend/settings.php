<!DOCTYPE html>
<html>
    <head>



        <?php require_once $path->layouts . '/metas.php'; ?>



    </head>
    <style media="screen">

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
                        <form class="">
                            <label for="">Backend route:</label>
                            <input class="L-input-1-s" type="text" name="note-title" placeholder="Enter note title here...">
                            <label for="">Log in route:</label>
                            <input class="L-input-1-s" type="text" name="note-title" placeholder="Enter note title here...">
                            <label for="">Log out route:</label>
                            <input class="L-input-1-s" type="text" name="note-title" placeholder="Enter note title here...">
                        </form>
                        <br>
                        <button class="L-button-4-s" type="button" name="button">Save</button>
                    </div>
                </div>
            </div>
        </div>



        <?php require_once $path->layouts . '/footer.php'; ?>



    </body>
    <script type="text/javascript">

    </script>
</html>
