<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex,nofollow,nosnippet,noodp,noarchive,noimageindex,none">
<meta name="googlebot" content="noindex,nofollow,nosnippet,noodp,noarchive,noimageindex,none">
<title><?php echo $routes['admin-fullname']?> | <?= $langs->indications()['registered_routes']['status'][$indexLang] ?></title>
<link href="https://fonts.googleapis.com/css?family=Lato|Roboto" rel=stylesheet>
<link rel=stylesheet href="<?php echo $routes['admin-assets'].'/stylesheets/lodeh.0.0.1.css';?>" media=screen title="no title" charset=utf-8>
<script src="<?php echo $routes['admin-assets'].'/scripts/jquery.js';?>"></script>
<script src="<?php echo $routes['admin-assets'].'/scripts/documentProperties.js';?>"></script>
<script src="<?php echo $routes['admin-assets'].'/scripts/sppropAction.js';?>"></script>
<script src="<?php echo $routes['admin-assets'].'/scripts/functions.js';?>"></script>
</head>
<body class="L-b-whitesmooth L-g-f-roboto">
<?php include($routes['admin-layouts'].'/header.php');?>
<br><br>
<div id=content class=tt>
<div id=content-inner class>
<div class="L-width-100 L-d-flex">
<div class="L-m-auto L-width-800px L-padding-20px">
<span class="L-g-f-lato L-font-24px">
<?= $langs->langs()['registered_routes']['header'][$indexLang] ?>
</span>
<br><br>
<span class=L-font-14px>
<?= $langs->langs()['registered_routes']['tagline'][$indexLang] ?>
</span>
<br><br>
<div class=L-font-14px>
<form id=create-route-form class>
<input type="hidden" name="_token" value="<?= $token ?>">
<div class="L-d-flex">
<input class="L-i-style-1-s L-width-100" type=text name="<?php echo md5('prefix')?>" placeholder="<?= $langs->indications()['prefix']['placeholder'][$indexLang] ?>">
</div>
<div class="L-d-flex">
<input class="L-i-style-1-s L-width-100" type=text name="<?php echo md5('route')?>" placeholder="<?= $langs->indications()['route']['placeholder'][$indexLang] ?>">
</div>
<label for><?= $langs->indications()['method']['status'][$indexLang] ?>:</label>
<input id=radio-get type=radio name="<?php echo md5('method')?>" value="GET" checked> GET
<input id=radio-post type=radio name="<?php echo md5('method')?>" value="POST"> POST
<br><br>
<label for><?= $langs->indications()['target']['status'][$indexLang] ?>:</label>
<input id=radio-none type=radio name="<?php echo md5('path')?>" value="none" checked> <?= $langs->indications()['none']['status'][$indexLang] ?> (<?= $langs->indications()['default']['status'][$indexLang] ?>)
<input id=radio-path type=radio name="<?php echo md5('path')?>" value="path"> <?= $langs->indications()['path']['status'][$indexLang] ?>
<div class="L-d-flex">
<input id=input-path-value class="L-i-style-1-s L-i-disabled L-width-100" type=text name="<?php echo md5('path-value')?>" placeholder="<?= $langs->indications()['path']['placeholder'][$indexLang] ?>">
</div>
</form>
<button id=create-route-button class=L-b-style-1-s><?= $langs->indications()['register']['button_route'][$indexLang] ?></button>
<div class="L-width-100 L-o-auto L-p-relative L-bottom">
<p id=alert class="L-d-none L-n-style-1-danger L-t-a-center"></p>
</div>
</div>
<br><br>
<div id=sort-properties-loading>
<div id=sort-properties-loading-inner>
<span>Loading...</span>
</div>
</div>
<div id=route-loading class="spprop-general-loading">
<div id=route-loading-inner class="spprop-general-loading-inner">
<span>Loading...</span>
</div>
</div>
</div>
</div>
<div class="L-width-100 L-o-auto L-p-fixed L-bottom" style="margin:0 0 -16px">
<p id=alert-bottom class="L-d-none L-n-style-1-danger L-t-a-center"></p>
</div>
</div>
</div>
<?php include($routes['admin-layouts'].'/footer.php');?>
<input id=index-dashboard type=hidden value="<?php echo $routes['route-dashboard'];?>">
<input id=index-lang-save type=hidden value="<?= $langs->indications($langs->contents()['route']['no_plural'][$indexLang])['save']['process'][$indexLang] ?>">
<input id=index-lang-delete type=hidden value="<?= $langs->indications($langs->contents()['route']['no_plural'][$indexLang])['delete']['process'][$indexLang] ?>">
<input id=index-lang-register type=hidden value="<?= $langs->indications($langs->contents()['route']['no_plural'][$indexLang])['register']['process'][$indexLang] ?>">
<script type=text/javascript>$(window).load(function(){var a=documentProperties();a.objectContent.indexUrl=a.dinamicCreateContentUrl();a.objectContent.redirect="load";a.objectContent.alert="#alert";a.objectContent.mainLoading="#route-loading";a.objectContent.innerLoading="#route-loading-inner";a.objectContent.formCreateTarget="#create-route-form";a.objectContent.buttonCreateTarget="#create-route-button";a.objectContent.notice=a.indexLang.register;ajax(a.objectAjaxProperties());loading(a.dinamicAllContentsUrl(),a.objectContent.mainLoading,a.objectContent.innerLoading);a.objectContent.indexUrl=a.dinamicEditContentUrl();a.objectContent.alert="#alert-bottom";a.objectContent.classNameIdentifier=".task-save";a.objectContent.formIdentifier=".div-form-save-";a.objectContent.splitIdentifier=2;a.objectContent.notice=a.indexLang.save;ajaxFromTarget(a.objectAjaxProperties(),a.objectIndentifierProperties());a.objectContent.indexUrl=a.dinamicDeleteContentUrl();a.objectContent.classNameIdentifier=".task-delete";a.objectContent.formIdentifier="#task-form-delete-";a.objectContent.notice=a.indexLang.delete;ajaxFromTarget(a.objectAjaxProperties(),a.objectIndentifierProperties());a.objectContent.classNameIdentifier=".task-edit";a.objectContent.tableEditIdentifier="#div-content-edit-";a.objectContent.splitIdentifier=2;displayTableEdit(a.objectIndentifierProperties(),a.objectContent.tableEditIdentifier);a.objectContent.indexUrl=a.dinamicSortContentUrl();a.objectContent.mainLoading="#sort-properties-loading";a.objectContent.innerLoading="#sort-properties-loading-inner";loading(a.objectContent.indexUrl,a.objectContent.mainLoading,a.objectContent.innerLoading);a.objectShowHide.classNameShow=".task-notice-delete";a.objectShowHide.classNameHide=".task-cancel";a.objectShowHide.elementSplitShow=3;a.objectShowHide.elementSplitHide=2;a.objectShowHide.targetShow="#parent-index-task-notice-";a.objectShowHide.targetHide="#parent-index-task-";showAndHideIndexes(a.objectShowHide.indexes(),a.objectShowHide.indexTarget());a.objectShowHide.classNameShow=".task-notice-delete-min";a.objectShowHide.classNameHide=".task-cancel-min";a.objectShowHide.targetShow="#parent-index-task-notice-min-";a.objectShowHide.targetHide="#parent-index-task-min-";showAndHideIndexes(a.objectShowHide.indexes(),a.objectShowHide.indexTarget());a.objectContent.mainLoading="#route-loading";a.objectContent.formCreateTarget=".index-id-form input:checkbox:checked";sppropAction(a);checkAllTarget(a.objectContent.parentCheckbox,a.objectContent.childCheckbox);a.objectContent.mainLoading="#route-loading";a.objectContent.innerLoading="#route-loading-inner";a.objectContent.classNameIdentifier=".index-page-ok";a.objectContent.splitIdentifier=3;dinamicPagination(a.objectPaginationProperties(),a);targetDisabled("#radio-path","#radio-none","#input-path-value")});</script>
</body>
</html>
