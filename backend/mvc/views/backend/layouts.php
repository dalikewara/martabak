<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex,nofollow,nosnippet,noodp,noarchive,noimageindex,none">
<meta name="googlebot" content="noindex,nofollow,nosnippet,noodp,noarchive,noimageindex,none">
<title><?php echo $layouts['admin-fullname']?> | <?= $langs->indications()['layouts_management']['status'][$indexLang] ?></title>
<link href="https://fonts.googleapis.com/css?family=Lato|Roboto" rel=stylesheet>
<link rel=stylesheet href="<?php echo $layouts['admin-assets'].'/stylesheets/lodeh.0.0.1.css';?>" media=screen title="no title" charset=utf-8>
<script src="<?php echo $layouts['admin-assets'].'/scripts/jquery.js';?>"></script>
<script src="<?php echo $layouts['admin-assets'].'/scripts/documentProperties.js';?>"></script>
<script src="<?php echo $layouts['admin-assets'].'/scripts/sppropAction.js';?>"></script>
<script src="<?php echo $layouts['admin-assets'].'/scripts/functions.js';?>"></script>
</head>
<body class="L-b-whitesmooth L-g-f-roboto">
<?php include($layouts['admin-layouts'].'/header.php');?>
<br><br>
<div id=content class=tt>
<div id=content-inner class>
<div class="L-width-100 L-d-flex">
<div class="L-m-auto L-width-800px L-padding-20px">
<span class="L-g-f-lato L-font-24px">
<?= $langs->langs()['layouts_management']['header'][$indexLang] ?>
</span>
<br><br>
<span class=L-font-14px>
<?= $langs->langs()['layouts_management']['tagline'][$indexLang] ?>
</span>
<br><br>
<div class=L-font-14px>
<form id=create-layout-form class>
<input type="hidden" name="_token" value="<?= $token ?>">
<div class=L-d-flex>
<input class=L-i-style-1-s type=text name="<?php echo md5('prefix')?>" placeholder="<?= $langs->indications()['prefix']['placeholder'][$indexLang] ?>" style=width:784px;margin-bottom:0>
</div>
<div class=L-d-flex>
<textarea class=L-ta-style-1-s name="<?php echo md5('content')?>" style=width:784px;height:150px placeholder="<?= $langs->indications()['textarea']['layout_placeholder'][$indexLang] ?>"></textarea>
</div>
</form>
<button id=create-layout-button class=L-b-style-1-s><?= $langs->indications()['create']['button_layout'][$indexLang] ?></button>
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
<div id=layout-loading class="spprop-general-loading">
<div id=layout-loading-inner class="spprop-general-loading-inner">
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
<?php include($layouts['admin-layouts'].'/footer.php');?>
<input id=index-dashboard type=hidden value="<?php echo $layouts['route-dashboard'];?>">
<input id=index-lang-save type=hidden value="<?= $langs->indications($langs->contents()['layout']['no_plural'][$indexLang])['save']['process'][$indexLang] ?>">
<input id=index-lang-delete type=hidden value="<?= $langs->indications($langs->contents()['layout']['no_plural'][$indexLang])['delete']['process'][$indexLang] ?>">
<input id=index-lang-create type=hidden value="<?= $langs->indications($langs->contents()['layout']['no_plural'][$indexLang])['create']['process'][$indexLang] ?>">
<script type=text/javascript>$(window).load(function()
{var properties=documentProperties();properties.objectContent.indexUrl=properties.dinamicCreateContentUrl();properties.objectContent.redirect='load';properties.objectContent.alert='#alert';properties.objectContent.mainLoading='#layout-loading';properties.objectContent.innerLoading='#layout-loading-inner';properties.objectContent.formCreateTarget='#create-layout-form';properties.objectContent.buttonCreateTarget='#create-layout-button';properties.objectContent.notice=properties.indexLang.create;ajax(properties.objectAjaxProperties());loading(properties.dinamicAllContentsUrl(),properties.objectContent.mainLoading,properties.objectContent.innerLoading);properties.objectContent.indexUrl=properties.dinamicEditContentUrl();properties.objectContent.alert='#alert-bottom';properties.objectContent.classNameIdentifier='.task-save';properties.objectContent.formIdentifier='.div-form-save-';properties.objectContent.splitIdentifier=2;properties.objectContent.notice=properties.indexLang.save;ajaxFromTarget(properties.objectAjaxProperties(),properties.objectIndentifierProperties());properties.objectContent.indexUrl=properties.dinamicDeleteContentUrl();properties.objectContent.classNameIdentifier='.task-delete';properties.objectContent.formIdentifier='#task-form-delete-';properties.objectContent.notice=properties.indexLang.delete;ajaxFromTarget(properties.objectAjaxProperties(),properties.objectIndentifierProperties());properties.objectContent.indexUrl=properties.dinamicSortContentUrl();properties.objectContent.mainLoading='#sort-properties-loading';properties.objectContent.innerLoading='#sort-properties-loading-inner';loading(properties.objectContent.indexUrl,properties.objectContent.mainLoading,properties.objectContent.innerLoading);properties.objectShowHide.classNameShow='.task-notice-delete';properties.objectShowHide.classNameHide='.task-cancel';properties.objectShowHide.elementSplitShow=3;properties.objectShowHide.elementSplitHide=2;properties.objectShowHide.targetShow='#parent-index-task-notice-';properties.objectShowHide.targetHide='#parent-index-task-';showAndHideIndexes(properties.objectShowHide.indexes(),properties.objectShowHide.indexTarget());properties.objectContent.mainLoading='#layout-loading';properties.objectContent.formCreateTarget='.index-id-form input:checkbox:checked';sppropAction(properties);checkAllTarget(properties.objectContent.parentCheckbox,properties.objectContent.childCheckbox);properties.objectContent.mainLoading='#layout-loading';properties.objectContent.innerLoading='#layout-loading-inner';properties.objectContent.classNameIdentifier='.index-page-ok';properties.objectContent.splitIdentifier=3;dinamicPagination(properties.objectPaginationProperties(),properties);targetDisabled('#radio-path','#radio-none','#input-path-value');});</script>
</body>
</html>
