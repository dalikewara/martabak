<?php
    // PLEASE DO NOT CHANGE ANYTHING IN THIS FILE!



    // Indications.
    $err = 0;
    $notice = null;
    $complete = 0;
    // Properties.
    $dbHost = $dbName = $dbUsername = $dbPassword = $fullname = $username =
    $email = $password = $confirmPassword = null;



    if(isset($_POST['submit']))
    {
        // This is where your Composer Autoload placed.
        $autoload = __DIR__ . '/../backend/vendor/autoload.php';
        // This is where your Database configuration placed.
        $db = __DIR__ . '/../backend/.secrets/.db';
        // This is where your Model placed.
        $models = __DIR__ . '/../handler/models';
        // Database configurations.
        $dbHost = $_POST['db_host'];
        $dbName = $_POST['db_name'];
        $dbUsername = $_POST['db_username'];
        $dbPassword = $_POST['db_password'];
        // User info.
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];

        // Generating autoload.
        require($autoload);

        // Gets requirements.
        $validation = new \tool\Validation;
        $model = new \controller\config\Model;

        // Validation
        if(preg_match('/[^a-z0-9\:\.\_\-]/i', $dbHost))
        {
            $err = 1;
            $notice = 'Wrong Database host format!';
        }

        if(preg_match('/[^a-z0-9\_]/i', $dbName))
        {
            $err = 1;
            $notice = 'Wrong Database name format!';
        }

        if(!$validation->username($dbUsername))
        {
            $err = 1;
            $notice = 'Wrong Database username format!';
        }

        if(!empty($dbPassword) AND !$validation->password($dbPassword))
        {
            $err = 1;
            $notice = 'Wrong Database password format!';
        }

        if(!$validation->fullname($fullname))
        {
            $err = 1;
            $notice = 'Wrong fullname format!';
        }

        if(!$validation->username($username))
        {
            $err = 1;
            $notice = 'Wrong username format!';
        }

        if(!$validation->email($email))
        {
            $err = 1;
            $notice = 'Wrong email format!';
        }

        if(!$validation->password($password) OR !$validation->password($confirmPassword))
        {
            $err = 1;
            $notice = 'Wrong password format!';
        }

        if($password !== $confirmPassword)
        {
            $err = 1;
            $notice = 'Your password confirmation doesn\'t match!';
        }

        if($err === 0)
        {
            // Puts Database configuration.
            file_put_contents($db, '{"DB_HOST": "' . $dbHost . '", "DB_NAME": "' . $dbName .
                '", "DB_USERNAME": "' . $dbUsername . '", "DB_PASSWORD": "' . $dbPassword . '"}');

            // Create new system tables.
            foreach(array_diff(scandir($models), array('..', '.')) as $file)
            {
                $name = str_replace('.php', '', $file);

                $model->$name->create();
            }

            // Generating current date & time.
            $dateNow = date('Y-m-d') . ' ' . date('H:i:s');

            // Insert new default system data.
            if(count($model->User->where(['username' => $username])->get(1)) < 1)
            {
                $model->User->insert([
                    'fullname' => $fullname,
                    'username' => $username,
                    'email' => $email,
                    'password' => md5($password),
                    'created_at' => $dateNow,
                    'updated_at' => $dateNow,
                ]);
            }
            foreach(array(['prefix' => 'backend', 'uri' => '/backend'], ['prefix'
            => 'login', 'uri' => '/login'], ['prefix' => 'logout', 'uri' => '/logout']) as $route)
            {
                if(count($model->Route->where(['prefix' => $route['prefix']])->get(1)) < 1)
                {
                    $model->Route->insert([
                        'prefix' => $route['prefix'],
                        'uri' => $route['uri'],
                        'target' => 'null',
                        'method' => 'GET',
                        'system' => 1,
                        'created_at' => $dateNow,
                        'updated_at' => $dateNow,
                    ]);
                }
            }
            foreach(array(['name' => 'homepage-landing', 'filename' => md5(
            'homepage-landing') . '.php'], ['name' => 'construction-landing',
            'filename' => md5('construction-landing') . '.php']) as $landing)
            {
                if(count($model->Landing->where(['name' => $landing['name']])->get(1)) < 1)
                {
                    $model->Landing->insert([
                        'name' => $landing['name'],
                        'filename' => $landing['filename'],
                        'status' => 1,
                        'created_at' => $dateNow,
                        'updated_at' => $dateNow,
                    ]);
                }
            }

            $complete = 1;
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex,nofollow,nosnippet,noodp,noarchive,noimageindex,none">
        <meta name="googlebot" content="noindex,nofollow,nosnippet,noodp,noarchive,noimageindex,none">
        <link rel="stylesheet" type="text/css" href="assets/main/plugins/font-awesome-4.6.3/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="assets/main/stylesheets/lodeh.css">
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        <title>Martabak installation</title>
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
                background: rgb(228, 228, 228);
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
                padding-top: 40px;
            }
            #notice {
                width: 300px;
                margin: auto;
                color: rgb(164, 48, 48);
            }
            #installation {
                width: 300px;
                background: rgb(255, 255, 255);
                box-shadow: 0 0 2px rgba(0, 0, 0, 0.3);
                margin: auto;
                border-radius: 5px;
            }
            #installation-inner {
                padding: 20px;
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
        </style>
    </head>
    <body>
        <div id="parent">
            <div id="child">
                <div id="notice">


                    <?php echo $notice; ?>



                </div>
                <br>
                <div id="installation">
                    <div id="installation-inner">
                        <?php if($complete === 0): ?>
                            <form class="" action="" method="post">
                                <strong>Your database configurations.</strong>
                                <br>
                                <small>Please make sure the data of your Database is valid.</small>
                                <br><br>
                                <span style="color:red">*</span> <small>Database host:</small>
                                <input class="L-input-1-s" type="text" name="db_host" value="<?php echo $dbHost; ?>" placeholder="Example: localhost" required>
                                <span style="color:red">*</span> <small>Database name:</small>
                                <input class="L-input-1-s" type="text" name="db_name" value="<?php echo $dbName; ?>" placeholder="Example: my_martabak" required>
                                <span style="color:red">*</span> <small>Database username:</small>
                                <input class="L-input-1-s" type="text" name="db_username" value="<?php echo $dbUsername; ?>" placeholder="Example: root" required>
                                <small>Database password:</small>
                                <input class="L-input-1-s" type="password" name="db_password" value="<?php echo $dbPassword; ?>" placeholder="Enter your Database password...">
                                <small>Martabak uses 'mysql' as default Database connection. It's the only one tested. But, if you want to try to use the other, you can set up manually on <i><u>backend/config/Database.php</u></i> before installing.</small>
                                <br><br>
                                <strong>Your info.</strong>
                                <br><br>
                                <small>Fullname:</small>
                                <input class="L-input-1-s" type="text" name="fullname" value="<?php echo $fullname; ?>" placeholder="Example: My Fullname">
                                <span style="color:red">*</span> <small>Username:</small>
                                <input class="L-input-1-s" type="text" name="username" value="<?php echo $username; ?>" placeholder="Example: myusername" required>
                                <small>Email:</small>
                                <input class="L-input-1-s" type="text" name="email" value="<?php echo $email; ?>" placeholder="Example: yourname@email.com">
                                <span style="color:red">*</span> <small>Password:</small>
                                <input class="L-input-1-s" type="password" name="password" value="<?php echo $password; ?>" placeholder="Enter your password..." required>
                                <span style="color:red">*</span> <small>Confirm password:</small>
                                <input class="L-input-1-s" type="password" name="confirm_password" value="<?php echo $confirmPassword; ?>" placeholder="Confrim your password..." required>
                                <input class="L-button-4-s" type="submit" name="submit" value="Install">
                                <br><br>
                                <i>
                                    * Note: The installation may take several minutes, so be patient until the installation is finish.
                                    Do not close the page or doing anything that can broke the progress.
                                </i>
                            </form>
                        <?php elseif($complete === 1): ?>
                            <h2 style="color:rgb(44, 159, 38)">Congratulation! Your installation has done. Now you can start using Martabak.</h2>
                            <hr>
                            <p>
                                This is your backend uri: <a href="/backend">/backend</a>. You may have to log in first
                                before you can access your backend. Your log in is <a href="/login">/login</a>.
                                You can change and custom that uris later.
                            </p>
                            <hr>
                            <br>
                            <a href="/"><button class="L-button-1-s" type="button" name="button"><i class="fa fa-home" aria-hidden="true"></i> Visit your homepage</button></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
