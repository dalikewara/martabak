<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Dali Kewara</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Reenie+Beanie" rel="stylesheet">
        <link href="/assets/main/plugins/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet">
        <style media="screen">
            body {
                width: 100%;
                margin: 0;
                min-height: 100%;
                font-family: "Raleway", sans-serif;
                line-height: 1.5;
                font-size: 16px;
                color: rgb(208, 208, 208);
                background: rgb(53, 53, 53);
                transition: all 0.2s;
            }
            a:link {
                color: rgb(226, 65, 80);
                text-shadow: 0 0 10px rgba(0, 0, 0, 1);
            }
            a:visited {
                color: rgb(226, 65, 80);
                text-shadow: 0 0 10px rgba(0, 0, 0, 1);
            }
            a:hover {
                color: rgb(226, 65, 80);
                text-decoration: none;
            }
            a:active {
                color: rgb(226, 65, 80);
                text-shadow: 0 0 10px rgba(0, 0, 0, 1);
            }
            #parent {

            }
            #child {
                margin: auto;
                width: 900px;
            }
            #content {

            }
            #content-inner {

            }
            #content-inner h1 {
                margin: 0 0 40px;
                font-size: 6em;
                margin: 0;
            }
            #content-inner h2 {
                margin: -40px 0 60px;
                font-size: 2em;
            }
            #content-inner p {
                padding: 0 20%;
            }
            #item {
            }
            #footer {
                color: rgb(100, 100, 100);
                text-shadow: 0 0 1px rgba(0, 0, 0, 1);
                text-align: center;
            }
            .inner-parent {
                padding: 15px 40px;
            }
            .inner-child {
                padding: 10px;
            }
            .flex {
                display: flex;
            }
            .full {
                width: 100%;
            }
            .text-center {
                text-align: center;
            }
            .text-right {
                text-align: right;
            }
            .sizing {
                box-sizing: border-box;
            }
            .separator {
                color: rgb(236, 236, 236);
                background: rgb(236, 236, 236);
            }
            .box {
                width: 100%;
                background: rgb(255, 255, 255);
                overflow: auto;
                box-shadow: 0 0 1px rgba(0, 0, 0, 1);
                padding: 10px;
                font-size: 12px;
            }
            .items {
                /*border-bottom: 1px solid rgb(230, 230, 230);*/
                margin-right: 15px;
                cursor: pointer;
                transition: all 0.2s;
            }
            .items:hover {
                color: rgb(226, 65, 80);
            }
            .large {
                /*font-size: 34px;*/
            }
            .background-image {
				background-size: cover;
				background-position: center;
				/*background-attachment: fixed;*/
				background-repeat: no-repeat;
            }
            .rounded-img {
                border-radius: 50%;
            }
            .title {
                font-family: 'Reenie Beanie', cursive;
            }
            .summary {
                color: rgb(100, 100, 100);
                text-shadow: 0 0 10px rgba(0, 0, 0, 1);
            }
        </style>
    </head>
    <body>
        <div id="parent" class="full">
            <div id="child">
                <!-- Start content -->
                <div id="content">
                    <div id="content-inner" class="text-center">
                        <br>
                        <h1 class="title">WELCOME</h1>
                        <h2 class="title">THIS IS YOUR HOMEPAGE</h2>
                        <p class="summary"><small>
                            Now, you just have to start <strong class="large">designing your page</strong>, and build your own page system website <strong class="large">by coding</strong>.
                            Yes, Martabak is <strong class="large">not drag & drop</strong> website builder, everything in here is <strong class="large">cover with codes</strong>. Don't be worried, you'll enjoy it.
						</small></p>
						<br>
                        <!-- Start footer -->
                        <p id="footer">
                            <small>2016 @ Martabak</small>
                        </p>
                        <!-- End footer -->
                    </div>
                </div>
                <!-- End content -->
            </div>
        </div>
    </body>
</html>
