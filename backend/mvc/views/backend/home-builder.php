<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex,nofollow,nosnippet,noodp,noarchive,noimageindex,none">
<meta name="googlebot" content="noindex,nofollow,nosnippet,noodp,noarchive,noimageindex,none">
<title><?php echo $homeBuilder['admin-fullname']?> | <?= $langs->indications()['home_builder']['status'][$indexLang] ?></title>
<link href="https://fonts.googleapis.com/css?family=Lato|Roboto" rel=stylesheet>
<link rel=stylesheet href="<?php echo $homeBuilder['admin-assets'].'/stylesheets/lodeh.0.0.1.css';?>" media=screen title="no title" charset=utf-8>
<link rel=stylesheet href="<?php echo $homeBuilder['admin-assets'].'/stylesheets/live.css';?>" media=screen title="no title" charset=utf-8>
<script src="<?php echo $homeBuilder['admin-assets'].'/scripts/jquery.js';?>"></script>
<script src="<?php echo $homeBuilder['admin-assets'].'/scripts/documentProperties.js';?>"></script>
<script src="<?php echo $homeBuilder['admin-assets'].'/scripts/functions.js';?>"></script>
<script src="<?php echo $homeBuilder['admin-assets'].'/scripts/livescript.js';?>"></script>
</head>
<body class="L-b-whitesmooth L-g-f-roboto">
<?php include($homeBuilder['admin-layouts'].'/header.php');?>
<br>
<div id=content style="padding:10px 0 0">
<div id=content-inner class=L-width-100>
<div class="L-width-100 L-b-blacksmooth">
<div class="L-c-whitesmoke L-padding-20px L-g-f-roboto L-font-14px L-l-height-1-5" style=margin-bottom:-20px>
<span class>
<?= $langs->langs()['home_builder']['tagline'][$indexLang] ?>
</span>
<br><br>
<span id=main-content-index>
<span><?= $langs->indications()['status']['status'][$indexLang] ?>: </span>
<span id=main-content-status>
<span id=inner-content-status>
<?php if($builder['status']==1):?>
<span class=L-c-green><u><?= $langs->indications()['publish']['status'][$indexLang] ?></u></span>
<?php else:?>
<span class=L-c-red><u><?= $langs->indications()['construction']['status'][$indexLang] ?></u></span>
<?php endif;?>
</span>
</span>
<span><?= $langs->indications()['last_updated']['status'][$indexLang] ?>: </span>
<span id=main-content-last-update>
<span id=inner-content-last-update>
<span><u><?php echo $builder['updated_at']?></u></span>
</span>
</span>
</span>
</div>
<form id=content-form-create>
<input type="hidden" name="_token" value="<?= $token ?>">
<input type=hidden name="<?php echo md5('content-'.$builder['id'])?>" value="<?php echo $builder['id']?>">
<div class="L-padding-20px L-d-flex">
<textarea id=index-code-mirror></textarea>
<textarea id=code-textarea class="L-d-none L-font-16px L-width-100 L-height-300px L-c-whitesmoke L-b-blacksmooth L-padding-20px" type=hidden name="<?php echo md5('content')?>" style="font-family:courier;border:0;border-left:1px solid #f567ed" placeholder="// Write or paste your code here." value="<?php echo $fileContent?>"></textarea>
</div>
</form>
<div class="L-c-whitesmoke L-g-f-lato L-h-style-1" style="padding:0 20px">
<input id=live-preview-input type=checkbox> <span id=lpi-label style=margin-right:15px>#<?= $langs->indications()['html_live_preview']['button'][$indexLang] ?></span>
<label style=margin-right:10px>#<?= $langs->indications()['insert_layout']['button'][$indexLang] ?>:</label>
<span id=main-insert-layout-loading>
Loading...
</span>
</div>
<div class="L-padding-20px L-c-whitesmoke L-g-f-lato" style=margin-bottom:-20px>
<span id=create-button-content-publish class="L-c-pointer L-h-style-1" style=margin-right:20px value="<?php echo md5('status')?>=1">#<?= $langs->indications()['publish']['button'][$indexLang] ?></span>
<span id=create-button-content-draft class="L-c-pointer L-h-style-1" style=margin-right:20px value="<?php echo md5('status')?>=2">#<?= $langs->indications()['construction']['button'][$indexLang] ?></span>
<span id=create-button-content-save class="L-c-pointer L-h-style-1" style=margin-right:20px>#<?= $langs->indications()['save']['button'][$indexLang] ?></span>
<span id=create-button-content-out class="L-c-pointer L-h-style-1" style=margin-right:20px>#<?= $langs->indications()['out']['button'][$indexLang] ?></span>
<span class=L-h-style-1>
<input id=create-button-content-realtime type=checkbox value="/home-builder/<?php echo str_replace('.php','',$builder['filename'])?>"> <span id=lpi-label style=margin-right:15px>#<?= $langs->indications()['realtime_preview']['button'][$indexLang] ?> <span class=L-font-12px>(support to PHP)</span></span>
</span>
</div>
</div>
<br><br>
<div id=live-preview-main class=L-d-none>
<div id=live-preview-heading class="L-width-100 L-t-a-center">HTML Preview:</div>
<hr>
<div id=live-preview-section>Loading...</div>
<div style=margin-bottom:80px></div>
</div>
<div id=realtime-preview-main class=L-d-none>
<div id=realtime-preview-heading class="L-width-100 L-t-a-center">Realtime Preview:</div>
<hr>
<div id=realtime-loading>
Loading...
</div>
<div style=margin-bottom:80px></div>
</div>
<div class="L-width-100 L-o-auto L-p-fixed L-bottom" style="margin:0 0 -16px">
<p id=alert-bottom class="L-d-none L-n-style-1-danger L-t-a-center"></p>
</div>
</div>
</div>
<input id=index-dashboard type=hidden value="<?php echo $homeBuilder['route-dashboard'];?>">
<input id=index-lang-save type=hidden value="<?= $langs->indications($langs->contents()['page']['no_plural'][$indexLang])['save']['process'][$indexLang] ?>">
<input id=index-lang-draft type=hidden value="<?= $langs->indications($langs->contents()['page']['no_plural'][$indexLang])['construction']['process'][$indexLang] ?>">
<input id=index-lang-publish type=hidden value="<?= $langs->indications($langs->contents()['page']['no_plural'][$indexLang])['publish']['process'][$indexLang] ?>">
<?php include($homeBuilder['admin-layouts'].'/footer.php');?>
<script type=text/javascript>$(window).load(function(){var b=document.getElementById("index-code-mirror");var c=CodeMirror(function(d){b.parentNode.replaceChild(d,b)},{value:b.value,lineNumbers:true,mode:"application/x-httpd-php",matchBrackets:true,indentUnit:4,indentWithTabs:true,});var a=documentProperties();a.objectContent.indexUrl=a.dinamicEditContentUrl();a.objectContent.redirect="self-content";a.objectContent.alert="#alert-bottom";a.objectContent.formCreateTarget="#content-form-create";a.objectContent.buttonCreateTarget="#create-button-content-publish";a.objectContent.notice=a.indexLang.publish;a.objectContent.mainLoading="#main-content-index";a.objectContent.loadUrl=a.dinamicMainContentsUrl()+" #main-content-index";ajax(a.objectAjaxProperties());a.objectContent.buttonCreateTarget="#create-button-content-draft";a.objectContent.notice=a.indexLang.draft;ajax(a.objectAjaxProperties());a.objectContent.buttonCreateTarget="#create-button-content-save";a.objectContent.notice=a.indexLang.save;ajax(a.objectAjaxProperties());a.objectContent.indexUrl=a.dinamicLayoutsContentUrl();a.objectContent.mainLoading="#main-insert-layout-loading";loading(a.objectContent.indexUrl,a.objectContent.mainLoading);realtimePreview("#create-button-content-realtime",a.dinamicRealtimePreviewUrl(),"#realtime-loading");c.getDoc().setValue($("#code-textarea").attr("value"));$("#code-textarea").val(c.getValue());$(document).on("click","#create-button-content-out",function(){$("body").fadeOut(function(){window.location.href=$("#index-dashboard").val()})});$(document).on("click","#live-preview-input",function(){$("#live-preview-main").fadeToggle();$("#live-preview-section").html(c.getValue())});$(document).on("keyup",".CodeMirror div textarea",function(){var d=c.getValue();$("#code-textarea").val(d);$("#live-preview-section").html(d)});$(document).on("change","#select-route-prefix",function(){$("#create-slug-prefix").text($(this).val())});$(document).on("change","#select-insert-layout",function(){var d=c.getValue()+$(this).val();c.getDoc().setValue(d)})});</script>
</body>
</html>
