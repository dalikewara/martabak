<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8>
<meta http-equiv=X-UA-Compatible content="IE=edge">
<meta name=viewport content="width=device-width, initial-scale=1">
<meta name=robots content=noindex,nofollow,nosnippet,noodp,noarchive,noimageindex,none>
<meta name=googlebot content=noindex,nofollow,nosnippet,noodp,noarchive,noimageindex,none>
<title><?php echo $dashboard['admin-fullname']?> | <?= $langs->indications()['dashboard']['status'][$indexLang] ?></title>
<link href="https://fonts.googleapis.com/css?family=Lato|Roboto" rel=stylesheet>
<link rel=stylesheet href="<?php echo $dashboard['admin-assets'].'/stylesheets/lodeh.0.0.1.css';?>" media=screen title="no title" charset=utf-8>
<script src="<?php echo $dashboard['admin-assets'].'/scripts/jquery.js';?>"></script>
<script src="<?php echo $dashboard['admin-assets'].'/scripts/functions.js';?>"></script>
</head>
<body class="L-b-blacksmoke L-c-whitesmooth L-g-f-roboto">
<?php include($dashboard['admin-layouts'].'/header.php');?>
<div id=content class>
<div id=content-inner class>
<div class="L-m-auto L-width-700px L-t-a-center" style=margin-top:120px>
<span class="L-font-3em L-g-f-lato"><?php echo $langs->langs()['dashboard']['header'][$indexLang]?></span>
<br><br><br>
<span class=L-font-20px><?php echo $langs->langs()['dashboard']['tagline'][$indexLang]?> <span style=margin-right:5px></span><a href="<?php echo $dashboard['request-create']?>"><button class="L-b-style-2-m L-font-18px"><?php echo $langs->langs()['dashboard']['tagline_button'][$indexLang]?></button></a></span>
<br><br><br><br><br>
</div>
<div class="L-width-100 L-d-flex">
<div class="L-m-auto L-width-800px L-padding-20px L-b-whitesmooth L-c-blacksmoke">
<div>
<span class="L-font-18px L-g-f-lato"><?php echo $langs->indications()['all_activities']['status'][$indexLang]?></span>
</div>
<hr>
<br>
<div class="L-font-14px L-c-blacksmooth">
<div class=L-d-flex style=margin-bottom:5px>
<div class="L-b-whitesmoke L-width-100 L-d-flex L-padding-10px">
<div class="L-f-left L-l-height-1-5" style=width:150px>
<b><?php echo $langs->indications()['you_have']['status'][$indexLang]?></b>
</div>
<div class="L-f-left L-l-height-1-5" style=width:15px>
<span><b>:</b> </span>
</div>
<div class="L-f-left L-w-wrap L-width-100 L-l-height-1-5">
<?php if(count($routes)>1):?>
<span class=L-font-14px><b><?php echo count($routes)?></b> Routes</span> <span>, </span>
<?php else:?>
<span class=L-font-14px><b><?php echo count($routes)?></b> Route</span> <span>, </span>
<?php endif;?>
<?php if(count($contents)>1):?>
<span class=L-font-14px><b><?php echo count($contents)?></b> Contents</span> <span>, </span>
<?php else:?>
<span class=L-font-14px><b><?php echo count($contents)?></b> Content</span> <span>, </span>
<?php endif;?>
<?php if(count($layouts)>1):?>
<span class=L-font-14px><b><?php echo count($layouts)?></b> Layouts</span> <span></span>
<?php else:?>
<span class=L-font-14px><b><?php echo count($layouts)?></b> Layout</span> <span></span>
<?php endif;?>
</div>
</div>
</div>
<div class=L-d-flex style=margin-bottom:5px>
<div class="L-b-whitesmoke L-width-100 L-d-flex L-padding-10px">
<div class="L-f-left L-l-height-1-5" style=width:150px>
<b><?php echo $langs->indications($langs->contents()['content']['plural'][$indexLang])['recent']['status'][$indexLang]?></b>
</div>
<div class="L-f-left L-l-height-1-5" style=width:15px>
<span><b>:</b> </span>
</div>
<div class="L-f-left L-w-wrap L-width-100 L-l-height-1-5">
<?php foreach($contents as $content):?>
<?php if($content['status']==1):?>
<a class="L-font-14px L-a-style-1-r L-l-height-1-5 L-c-blue" href="<?php echo $content['slug']?>" target=_blank><u><?php echo $content['title']?></u></a><span>, </span>
<?php endif;?>
<?php endforeach;?>
</div>
</div>
</div>
<div class=L-d-flex style=margin-bottom:5px>
<div class="L-b-whitesmoke L-width-100 L-d-flex L-padding-10px">
<div class="L-f-left L-l-height-1-5" style=width:150px>
<b><?php echo $langs->indications($langs->contents()['route']['plural'][$indexLang])['recent']['status'][$indexLang]?></b>
</div>
<div class="L-f-left L-l-height-1-5" style=width:15px>
<span><b>:</b> </span>
</div>
<div class="L-f-left L-w-wrap L-width-100 L-l-height-1-5">
<?php foreach($routes as $route):?>
<?php if($route['system']==0):?>
<?php if($route['path']!='null' AND $route['method']!='POST'):?>
<a class="L-font-14px L-a-style-1-r L-l-height-1-5 L-c-blue" href="<?php echo $route['route']?>" target=_blank><u><?php echo $route['prefix']?></u></a><span>, </span>
<?php else:?>
<span class="L-font-14px L-l-height-1-5"><?php echo $route['prefix']?></span><span>, </span>
<?php endif;?>
<?php endif;?>
<?php endforeach;?>
</div>
</div>
</div>
<div class=L-d-flex style=margin-bottom:5px>
<div class="L-b-whitesmoke L-width-100 L-d-flex L-padding-10px">
<div class="L-f-left L-l-height-1-5" style=width:150px>
<b><?php echo $langs->indications($langs->contents()['layout']['plural'][$indexLang])['recent']['status'][$indexLang]?></b>
</div>
<div class="L-f-left L-l-height-1-5" style=width:15px>
<span><b>:</b> </span>
</div>
<div class="L-f-left L-w-wrap L-width-100 L-l-height-1-5">
<?php foreach($layouts as $layout):?>
<span class="L-font-14px L-l-height-1-5"><?php echo $layout['prefix']?></span><span>, </span>
<?php endforeach;?>
</div>
</div>
</div>
</div>
</div>
</div>
<br><br>
</div>
</div>
<?php include($dashboard['admin-layouts'].'/footer.php');?>
</body>
</html>
