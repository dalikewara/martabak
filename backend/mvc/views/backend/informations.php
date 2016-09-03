<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8>
<meta http-equiv=X-UA-Compatible content="IE=edge">
<meta name=viewport content="width=device-width, initial-scale=1">
<meta name=robots content=noindex,nofollow,nosnippet,noodp,noarchive,noimageindex,none>
<meta name=googlebot content=noindex,nofollow,nosnippet,noodp,noarchive,noimageindex,none>
<title><?php echo $informations['admin-fullname']?> | <?= $langs->indications($langs->contents()['information']['plural'][$indexLang])['system_informations']['status'][$indexLang] ?></title>
<link href="https://fonts.googleapis.com/css?family=Lato|Roboto" rel=stylesheet>
<link rel=stylesheet href="<?php echo $informations['admin-assets'].'/stylesheets/lodeh.0.0.1.css';?>" media=screen title="no title" charset=utf-8>
<script src="<?php echo $informations['admin-assets'].'/scripts/jquery.js';?>"></script>
<script src="<?php echo $informations['admin-assets'].'/scripts/functions.js';?>"></script>
</head>
<body class="L-b-whitesmooth L-g-f-roboto">
<?php include($informations['admin-layouts'].'/header.php');?>
<br><br>
<div id=content class=tt>
<div id=content-inner class>
<div class="L-width-100 L-d-flex">
<div class="L-m-auto L-width-800px L-padding-20px">
<div class>
<span class="L-g-f-lato L-font-24px">
<?php echo $langs->indications($langs->contents()['information']['plural'][$indexLang])['system_informations']['header'][$indexLang]?>
</span>
<ul class="L-g-f-lato L-l-height-2 L-font-14px">
<li>
<?php echo $langs->indications()['version']['status'][$indexLang]?>: <b><?php echo $tables['version']?></b>
</li>
<li>
<?php echo $langs->indications()['codename']['status'][$indexLang]?>: <b><?php echo $tables['codename']?></b>
</li>
<li>
<?php echo $langs->indications()['author']['status'][$indexLang]?>: <b><?php echo $tables['author']?></b>
</li>
<li>
<?php echo $langs->indications()['released_at']['status'][$indexLang]?>: <b><?php echo $tables['released_at']?></b>
</li>
<li>
<?php echo $langs->indications()['license']['status'][$indexLang]?>: <b><?php echo $tables['license']?></b>
</li>
</ul>
</div>
</div>
</div>
<div class="L-width-100 L-o-auto L-p-fixed L-bottom" style="margin:0 0 -16px">
<p id=alert-bottom class="L-d-none L-n-style-1-danger L-t-a-center"></p>
</div>
</div>
</div>
<?php include($informations['admin-layouts'].'/footer.php');?>
</body>
</html>
