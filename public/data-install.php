<?php

$error      = 0;
$type       = $_POST['type'];
$host       = $_POST['db-host'];
$dbName     = $_POST['db-name'];
$dbCon      = $_POST['db-connection'];
$dbUsername = $_POST['db-username'];
$dbPassword = $_POST['db-password'];

if($type == 'database')
{
    if($host != NULL AND $dbName != NULL AND $dbCon != NULL AND $dbUsername != NULL)
    {
        try
        {
            switch($dbCon)
            {
                case 'mysql':
                    $pdo = new PDO("$dbCon: host=$host; dbname=$dbName", "$dbUsername", "$dbPassword");
                    break;
            }

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $pdo = NULL;
        }
        catch(PDOException $e)
        {
            $error = 1;
        }
    }
    else
    {
        $error = 1;
    }
}

if($type == 'account')
{

}

if($type == 'done')
{

}

if($error == 0)
{
    echo 'success.';
}
else
{
    echo 'There was an error. <br><br> ' . $e->getMessage();
}
