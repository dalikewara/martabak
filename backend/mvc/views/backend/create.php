<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex,nofollow,nosnippet,noodp,noarchive,noimageindex,none">
<meta name="googlebot" content="noindex,nofollow,nosnippet,noodp,noarchive,noimageindex,none">
<title><?php echo $create['admin-fullname']?> | <? if(isset($editTitle)): ?><?= $editTitle ?><? else: ?><?= $langs->indications()['new_content']['status'][$indexLang] ?><? endif; ?></title>
<link href="https://fonts.googleapis.com/css?family=Lato|Roboto" rel=stylesheet>
<link rel=stylesheet href="<?php echo $create['admin-assets'].'/stylesheets/lodeh.0.0.1.css';?>" media=screen title="no title" charset=utf-8>
<link rel=stylesheet href="<?php echo $create['admin-assets'].'/stylesheets/live.css';?>" media=screen title="no title" charset=utf-8>
<script src="<?php echo $create['admin-assets'].'/scripts/jquery.js';?>"></script>
<script src="<?php echo $create['admin-assets'].'/scripts/documentProperties.js';?>"></script>
<script src="<?php echo $create['admin-assets'].'/scripts/functions.js';?>"></script>
<script src="<?php echo $create['admin-assets'].'/scripts/livescript.js';?>"></script>
</head>
<body class="L-b-whitesmooth L-g-f-roboto">
<?php include($create['admin-layouts'].'/header.php');?>
<br>
<div id=content style="padding:10px 0 0">
<div id=content-inner class=L-width-100>
<div class="L-width-100 L-b-blacksmooth">
<form id=content-form-create>
<input type=hidden name=_token value="<?php echo $token?>">
<?php if($type=='edit'):?>
<input type=hidden name="<?php echo md5('content-'.$dataContent['id'])?>" value="<?php echo md5($content['id'])?>">
<?php endif;?>
<div class="L-padding-20px L-c-whitesmoke L-g-f-lato" style=margin-bottom:-20px>
<div class>
<label style=margin-right:10px>#<?php echo $langs->indications()['route_prefix']['button'][$indexLang]?>:</label>
<span id=main-routes-prefix-loading>
Loading...
</span>
</div>
<label>#<?php echo $langs->indications()['title']['status'][$indexLang]?>:</label>
<?php if($type=='edit'):?>
<input id=create-title class="L-i-style-2-s L-c-whitesmoke" type=text name="<?php echo md5('title')?>" value="<?php echo $dataContent['title']?>" placeholder="<?php echo $langs->indications()['title']['create_placeholder'][$indexLang]?>">
<?php elseif($type=='create'):?>
<input id=create-title class="L-i-style-2-s L-c-whitesmoke" type=text name="<?php echo md5('content-title')?>" placeholder="<?php echo $langs->indications()['title']['create_placeholder'][$indexLang]?>">
<?php endif;?>
<label>#<?php echo $langs->indications()['slug']['status'][$indexLang]?>:</label>
<?php if($type=='edit'):?>
<span id=create-slug-prefix style=margin-left:10px value="<?php echo ltrim($dataContent['route_prefix'],'/')?>"><?php echo $dataContent['route_prefix']?></span>
<span style=margin-right:-10px>/</span>
<input id=create-slug class="L-i-style-2-s L-c-whitesmoke" type=text name="<?php echo md5('slug')?>" value="<?php echo ltrim(str_replace($dataContent['route_prefix'],'',$dataContent['slug']),'/')?>" placeholder="<?php echo $langs->indications()['slug']['create_placeholder'][$indexLang]?>">
<?php elseif($type=='create'):?>
<span id=create-slug-prefix style=margin-left:10px value></span>
<span style=margin-right:-10px>/</span>
<input id=create-slug class="L-i-style-2-s L-c-whitesmoke" type=text name="<?php echo md5('content-slug')?>" placeholder="<?php echo $langs->indications()['slug']['create_placeholder'][$indexLang]?>">
<?php endif;?>
<?php if($type=='edit'):?>
<span id=main-content-index>
<span><?php echo $langs->indications()['status']['status'][$indexLang]?>: </span>
<span id=main-content-status>
<span id=inner-content-status>
<span><u>
<?php if($dataContent['status']==1):?>
<span class=L-c-green><?php echo $langs->indications()['publish']['status'][$indexLang]?></span>
<?php elseif($dataContent['status']==2):?>
<span class=L-c-orange><?php echo $langs->indications()['draft']['status'][$indexLang]?></span>
<?php else:?>
<span class=L-c-red><?php echo $langs->indications()['undefined']['status'][$indexLang]?></span>
<?php endif;?>
</u></span>
</span>
</span>
<span><?php echo $langs->indications()['last_updated']['status'][$indexLang]?>: </span>
<span id=main-content-last-update>
<span id=inner-content-last-update>
<span><u><?php echo $dataContent['updated_at']?></u></span>
</span>
</span>
</span>
<?php endif;?>
</div>
<div class="L-padding-20px L-d-flex">
<textarea id=index-code-mirror></textarea>
<?php if($type=='create'):?>
<textarea id=code-textarea class="L-d-none L-font-16px L-width-100 L-height-300px L-c-whitesmoke L-b-blacksmooth L-padding-20px" type=hidden name="<?php echo md5('content')?>" style="font-family:courier;border:0;border-left:1px solid #f567ed" placeholder="// Write or paste your code here." value></textarea>
<?php elseif($type=='edit'):?>
<textarea id=code-textarea class="L-d-none L-font-16px L-width-100 L-height-300px L-c-whitesmoke L-b-blacksmooth L-padding-20px" type=hidden name="<?php echo md5('content')?>" style="font-family:courier;border:0;border-left:1px solid #f567ed" placeholder="// Write or paste your code here." value="<?php echo $dataFileContent?>"></textarea>
<?php endif;?>
</div>
</form>
<div class="L-c-whitesmoke L-g-f-lato L-h-style-1" style="padding:0 20px">
<input id=live-preview-input type=checkbox> <span id=lpi-label style=margin-right:15px>#<?php echo $langs->indications()['html_live_preview']['button'][$indexLang]?></span>
<label style=margin-right:10px>#<?php echo $langs->indications()['insert_layout']['button'][$indexLang]?>:</label>
<span id=main-insert-layout-loading>
Loading...
</span>
</div>
<div class="L-padding-20px L-c-whitesmoke L-g-f-lato" style=margin-bottom:-20px>
<?php if($type=='create'):?>
<span id=create-button-content-publish class="L-c-pointer L-h-style-1" style=margin-right:20px value="<?php echo md5('content-status')?>=1">#<?php echo $langs->indications()['publish']['button'][$indexLang]?></span>
<span id=create-button-content-draft class="L-c-pointer L-h-style-1" style=margin-right:20px value="<?php echo md5('content-status')?>=2">#<?php echo $langs->indications()['draft']['button'][$indexLang]?></span>
<?php elseif($type=='edit'):?>
<span id=create-button-content-publish-edit class="L-c-pointer L-h-style-1" style=margin-right:20px value="<?php echo md5('status')?>=1">#<?php echo $langs->indications()['publish']['button'][$indexLang]?></span>
<span id=create-button-content-draft-edit class="L-c-pointer L-h-style-1" style=margin-right:20px value="<?php echo md5('status')?>=2">#<?php echo $langs->indications()['draft']['button'][$indexLang]?></span>
<span id=create-button-content-save-edit class="L-c-pointer L-h-style-1" style=margin-right:20px>#<?php echo $langs->indications()['save']['button'][$indexLang]?></span>
<?php endif;?>
<span id=create-button-content-out class="L-c-pointer L-h-style-1" style=margin-right:20px>#<?php echo $langs->indications()['out']['button'][$indexLang]?></span>
<?php if($type=='edit'):?>
<span class=L-h-style-1>
<input id=create-button-content-realtime type=checkbox value=/content/<?php echo str_replace('.php','',$dataContent['filename'])?>> <span id=lpi-label style=margin-right:15px>#<?php echo $langs->indications()['realtime_preview']['button'][$indexLang]?> <span class=L-font-12px>(support to PHP)</span></span>
</span>
<?php endif;?>
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
<input id=index-dashboard type=hidden value="<?php echo $create['route-dashboard'];?>">
<input id=index-lang-save type=hidden value="<?php echo $langs->indications($langs->contents()['content']['no_plural'][$indexLang])['save']['process'][$indexLang]?>">
<input id=index-lang-draft type=hidden value="<?php echo $langs->indications($langs->contents()['content']['no_plural'][$indexLang])['draft']['process'][$indexLang]?>">
<input id=index-lang-publish type=hidden value="<?php echo $langs->indications($langs->contents()['content']['no_plural'][$indexLang])['publish']['process'][$indexLang]?>">
<?php include($create['admin-layouts'].'/footer.php');?>
<script type=text/javascript>$(window).load(function(){var b=document.getElementById("index-code-mirror");var c=CodeMirror(function(d){b.parentNode.replaceChild(d,b)},{value:b.value,lineNumbers:true,mode:"application/x-httpd-php",matchBrackets:true,indentUnit:4,indentWithTabs:true,});var a=documentProperties();autoFillReplace("#create-title","#create-slug","-");a.objectContent.indexUrl=a.dinamicCreateContentUrl();a.objectContent.redirect="content";a.objectContent.alert="#alert-bottom";a.objectContent.formCreateTarget="#content-form-create";a.objectContent.buttonCreateTarget="#create-button-content-publish";a.objectContent.notice=a.indexLang.publish;ajax(a.objectAjaxProperties());a.objectContent.buttonCreateTarget="#create-button-content-draft";a.objectContent.notice=a.indexLang.draft;ajax(a.objectAjaxProperties());a.objectContent.mainLoading="#main-content-index";a.objectContent.loadUrl=a.url+" #main-content-index";a.objectContent.redirect="self-content";a.objectContent.indexUrl=a.dinamicCustomEditContentUrl();a.objectContent.buttonCreateTarget="#create-button-content-save-edit";a.objectContent.notice=a.indexLang.save;ajax(a.objectAjaxProperties());a.objectContent.buttonCreateTarget="#create-button-content-publish-edit";a.objectContent.notice=a.indexLang.publish;ajax(a.objectAjaxProperties());a.objectContent.buttonCreateTarget="#create-button-content-draft-edit";a.objectContent.notice=a.indexLang.draft;ajax(a.objectAjaxProperties());a.objectContent.indexUrl=a.dinamicLayoutsContentUrl();a.objectContent.mainLoading="#main-insert-layout-loading";loading(a.objectContent.indexUrl,a.objectContent.mainLoading);a.objectContent.customPrefix=$("#create-slug-prefix").attr("value");a.objectContent.indexUrl=a.dinamicRoutesPrefixUrl();a.objectContent.mainLoading="#main-routes-prefix-loading";loading(a.objectContent.indexUrl,a.objectContent.mainLoading);realtimePreview("#create-button-content-realtime",a.dinamicRealtimePreviewUrl(),"#realtime-loading");c.getDoc().setValue($("#code-textarea").attr("value"));$("#code-textarea").val(c.getValue());$(document).on("click","#create-button-content-out",function(){$("body").fadeOut(function(){window.location.href=a.dinamicMainContentsUrl()})});$(document).on("click","#live-preview-input",function(){$("#live-preview-main").fadeToggle();$("#live-preview-section").html(c.getValue())});$(document).on("keyup",".CodeMirror div textarea",function(){var d=c.getValue();$("#code-textarea").val(d);$("#live-preview-section").html(d)});$(document).on("change","#select-route-prefix",function(){$("#create-slug-prefix").text($(this).val())});$(document).on("change","#select-insert-layout",function(){var d=c.getValue()+$(this).val();c.getDoc().setValue(d);$("#code-textarea").val(d)})});</script>
</body>
</html>
