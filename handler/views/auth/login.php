<!DOCTYPE html>
<html>
    <head>



        <?php require_once $path->layouts . '/metas.php'; ?>



        <style>
        body {
            background: rgb(240, 240, 240);
        }
        input {

        }
        #parent {
            width: 100%;
            height: 410px;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
        }
        #child {
            width: 400px;
            display: block;
            padding: 0 20px 20px;
            background: rgb(255, 255, 255);
        }
        #logo {
            opacity: 0.5;
            transition: all 0.5s;
        }
        #logo:hover {
            opacity: 1;
        }
        #logo img {
            width: 30px;
            height: 30px;
            margin: 3px 0 0;
        }
        #footer {
            width: 100%;
            text-align: left;
        }
        #footer-inner {
            display: flex;
        }
        #footer-child-left {
            width: 40px;
            border-right: 1px solid rgb(222, 222, 222);
        }
        #footer-child-right {
            width: 100%;
            padding-left: 10px;
        }
        #notice {
            margin: 0;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
        @media only screen and (max-width: 400px)
        {
            #parent {
                width: 100%;
                box-sizing: border-box;
                height: 100%;
            }
            #child {
                border-radius: 0;
                border: none;
            }
            body {
                background: rgb(255, 255, 255);
            }
        }
        </style>
    </head>
    <body>



        <?php require_once $path->layouts . '/notice.php'; ?>



        <div id="parent">
            <div id="child" class="L-box-1">
                <div class"child-inner">
                    <h1 class="L-c-smokeBlack">Log in to backend.</h1>
                    <p class="L-c-smokeBlack">You have full control of your own website, and it's going to be easy to develop that make you love it.</p>
                </div>
                <div class="child-inner">
                    <form id="form-log-in">
                        <input class="L-input-1-s" type="text" name="user" placeholder="Enter your username...">
                        <input class="L-input-1-s" type="password" name="password" placeholder="Enter your password...">
                        <input type="hidden" name="__token" value="token here">
                    </form>
                    <button id="btn-log-in" class="L-button-4-s"><i class="fa fa-sign-in" aria-hidden="true"></i> Log in</button>
                </div>
                <br>
                <div id="footer" class="child-inner L-footer-1">
                    <div id="footer-inner">
                        <div id="footer-child-left" class="footer-child">
                            <div id="logo">
                                <img src="<?php echo $path->main_assets . '/images/martabak.png'; ?>" alt="Martabak Logo 2016" title="2016 &copy; Martabak Logo">
                            </div>
                        </div>
                        <div id="footer-child-right" class="footer-child">
                            <span>2016 &copy; Martabak.</span>
                            <br>
                            <span>Martabak is an open sourced Page System and Self-Hosted Website Manager, and always will be.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
