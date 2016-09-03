<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex,nofollow,nosnippet,noodp,noarchive,noimageindex,none">
<meta name="googlebot" content="noindex,nofollow,nosnippet,noodp,noarchive,noimageindex,none">
<title><?php echo $contents['admin-fullname']?> | <?= $langs->indications()['contents_storage']['status'][$indexLang] ?></title>
<link href="https://fonts.googleapis.com/css?family=Lato|Roboto" rel=stylesheet>
<link rel=stylesheet href="<?php echo $contents['admin-assets'].'/stylesheets/lodeh.0.0.1.css';?>" media=screen title="no title" charset=utf-8>
<script src="<?php echo $contents['admin-assets'].'/scripts/jquery.js';?>"></script>
<script src="<?php echo $contents['admin-assets'].'/scripts/documentProperties.js';?>"></script>
<script src="<?php echo $contents['admin-assets'].'/scripts/sppropAction.js';?>"></script>
<script src="<?php echo $contents['admin-assets'].'/scripts/functions.js';?>"></script>
</head>
<body class="L-b-whitesmooth L-g-f-roboto">
<?php include($contents['admin-layouts'].'/header.php');?>
<br><br>
<div id=content class=tt>
<div id=content-inner class>
<div class="L-width-100 L-d-flex">
<div class="L-m-auto L-width-800px L-padding-20px">
<span class="L-g-f-lato L-font-24px">
<?= $langs->langs()['contents_storage']['header'][$indexLang] ?>
</span>
<br><br>
<span class=L-font-14px>
<?= $langs->langs()['contents_storage']['tagline'][$indexLang] ?>
</span>
<br><br>
<div id=sort-properties-loading>
<div id=sort-properties-loading-inner>
<span>Loading...</span>
</div>
</div>
<div id=content-loading class="spprop-general-loading">
<div id=content-loading-inner class="spprop-general-loading-inner">
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
<?php include($contents['admin-layouts'].'/footer.php');?>
<input id=index-dashboard type=hidden value="<?php echo $contents['route-dashboard'];?>">
<input id=index-lang-save type=hidden value="<?= $langs->indications($langs->contents()['content']['no_plural'][$indexLang])['save']['process'][$indexLang] ?>">
<input id=index-lang-delete type=hidden value="<?= $langs->indications($langs->contents()['content']['no_plural'][$indexLang])['delete']['process'][$indexLang] ?>">
<input id=index-lang-draft type=hidden value="<?= $langs->indications($langs->contents()['content']['no_plural'][$indexLang])['draft']['process'][$indexLang] ?>">
<input id=index-lang-publish type=hidden value="<?= $langs->indications($langs->contents()['content']['no_plural'][$indexLang])['publish']['process'][$indexLang] ?>">
<script type=text/javascript>$(window).load(function()
{var properties=documentProperties();properties.objectContent.redirect='load';properties.objectContent.alert='#alert-bottom';properties.objectContent.mainLoading='#content-loading';properties.objectContent.innerLoading='#content-loading-inner';loading(properties.dinamicAllContentsUrl(),properties.objectContent.mainLoading,properties.objectContent.innerLoading);properties.objectContent.indexUrl=properties.dinamicEditContentUrl();properties.objectContent.alert='#alert-bottom';properties.objectContent.classNameIdentifier='.task-save';properties.objectContent.formIdentifier='.div-form-save-';properties.objectContent.splitIdentifier=2;properties.objectContent.notice=properties.indexLang.save;ajaxFromTarget(properties.objectAjaxProperties(),properties.objectIndentifierProperties());properties.objectContent.indexUrl=properties.dinamicEditContentUrl();properties.objectContent.alert='#alert-bottom';properties.objectContent.classNameIdentifier='.task-status';properties.objectContent.formIdentifier='.div-form-status-';properties.objectContent.splitIdentifier=2;properties.objectContent.notice=properties.indexLang.save;ajaxFromTarget(properties.objectAjaxProperties(),properties.objectIndentifierProperties(), properties);properties.objectContent.indexUrl=properties.dinamicDeleteContentUrl();properties.objectContent.classNameIdentifier='.task-delete';properties.objectContent.formIdentifier='#task-form-delete-';properties.objectContent.notice=properties.indexLang.delete;ajaxFromTarget(properties.objectAjaxProperties(),properties.objectIndentifierProperties());properties.objectContent.classNameIdentifier='.task-edit';properties.objectContent.tableEditIdentifier='#div-content-edit-';properties.objectContent.splitIdentifier=2;displayTableEdit(properties.objectIndentifierProperties(),properties.objectContent.tableEditIdentifier);properties.objectContent.indexUrl=properties.dinamicSortContentUrl();properties.objectContent.mainLoading='#sort-properties-loading';properties.objectContent.innerLoading='#sort-properties-loading-inner';loading(properties.objectContent.indexUrl,properties.objectContent.mainLoading,properties.objectContent.innerLoading);properties.objectShowHide.classNameShow='.task-notice-delete';properties.objectShowHide.classNameHide='.task-cancel';properties.objectShowHide.elementSplitShow=3;properties.objectShowHide.elementSplitHide=2;properties.objectShowHide.targetShow='#parent-index-task-notice-';properties.objectShowHide.targetHide='#parent-index-task-';showAndHideIndexes(properties.objectShowHide.indexes(),properties.objectShowHide.indexTarget());properties.objectContent.mainLoading='#content-loading';properties.objectContent.formCreateTarget='.index-id-form input:checkbox:checked';sppropAction(properties);checkAllTarget(properties.objectContent.parentCheckbox,properties.objectContent.childCheckbox);properties.objectContent.mainLoading='#content-loading';properties.objectContent.innerLoading='#content-loading-inner';properties.objectContent.classNameIdentifier='.index-page-ok';properties.objectContent.splitIdentifier=3;dinamicPagination(properties.objectPaginationProperties(),properties);targetDisabled('#radio-path','#radio-none','#input-path-value');});</script>
</body>
</html>
