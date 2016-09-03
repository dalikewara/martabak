<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex,nofollow,nosnippet,noodp,noarchive,noimageindex,none">
<meta name="googlebot" content="noindex,nofollow,nosnippet,noodp,noarchive,noimageindex,none">
<title><?php echo $settings['admin-fullname']?> | <?= $setLangs->indications()['system_settings']['status'][$indexLang] ?></title>
<link href="https://fonts.googleapis.com/css?family=Lato|Roboto" rel=stylesheet>
<link rel=stylesheet href="<?php echo $settings['admin-assets'].'/stylesheets/lodeh.0.0.1.css';?>" media=screen title="no title" charset=utf-8>
<script src="<?php echo $settings['admin-assets'].'/scripts/jquery.js';?>"></script>
<script src="<?php echo $settings['admin-assets'].'/scripts/documentProperties.js';?>"></script>
<script src="<?php echo $settings['admin-assets'].'/scripts/functions.js';?>"></script>
</head>
<body class="L-b-whitesmooth L-g-f-roboto">
<?php include($settings['admin-layouts'].'/header.php');?>
<br><br>
<div id=content class=tt>
<div id=content-inner class>
<div class="L-width-100 L-d-flex">
<div class="L-m-auto L-width-800px L-padding-20px">
<div>
<span>
<?php echo $setLangs->langs()['system_settings']['tagline'][$indexLang]?>
</span>
</div>
<br><br>
<span class="L-g-f-lato L-font-24px">
<?php echo $setLangs->indications()['profile_info']['status'][$indexLang]?>
</span>
<br>
<div id=main-loading-setting-profile class=L-font-14px>
<form id=setting-profile-form class>
<input type=hidden name=_token value="<?php echo $token?>">
<input type=hidden name="<?php echo md5('type-setting')?>" value="<?php echo md5('profile')?>">
<input type=hidden name="<?php echo md5('user-'.$userInfo['id'])?>" value="<?php echo md5($userInfo['id'])?>">
<div class=L-d-flex>
<input class=L-i-style-1-s type=text name="<?php echo md5('fullname')?>" value="<?php echo $userInfo['fullname']?>" placeholder="<?php echo $setLangs->indications()['fullname']['setting_placeholder'][$indexLang]?>" style=width:784px;margin-bottom:0>
</div>
<div class=L-d-flex>
<input class=L-i-style-1-s type=text name="<?php echo md5('username')?>" value="<?php echo $userInfo['username']?>" placeholder="<?php echo $setLangs->indications()['username']['setting_placeholder'][$indexLang]?>" style=width:784px;margin-bottom:0>
</div>
<div class=L-d-flex>
<input class=L-i-style-1-s type=text name="<?php echo md5('email')?>" value="<?php echo $userInfo['email']?>" placeholder="<?php echo $setLangs->indications()['email']['setting_placeholder'][$indexLang]?>" style=width:784px;margin-bottom:0>
</div>
<br>
<span>
<?php echo $setLangs->indications()['password']['setting_tagline'][$indexLang]?>
</span>
<div class=L-d-flex>
<input class=L-i-style-1-s type=password name="<?php echo md5('old-password')?>" placeholder="<?php echo $setLangs->indications()['password']['old_placeholder'][$indexLang]?>" style=width:784px;margin-bottom:0>
</div>
<div class=L-d-flex>
<input class=L-i-style-1-s type=password name="<?php echo md5('new-password')?>" placeholder="<?php echo $setLangs->indications()['password']['new_placeholder'][$indexLang]?>" style=width:784px;margin-bottom:0>
</div>
<div class=L-d-flex>
<input class=L-i-style-1-s type=password name="<?php echo md5('confirm-password')?>" placeholder="<?php echo $setLangs->indications()['password']['confirm_placeholder'][$indexLang]?>" style=width:784px;margin-bottom:0>
</div>
</form>
<br>
<button id=setting-profile-button class=L-b-style-1-s><?php echo $setLangs->indications()['update']['button_profile_info'][$indexLang]?></button>
</div>
<br><br>
<span class="L-g-f-lato L-font-24px">
<?php echo $setLangs->indications()['optional_settings']['status'][$indexLang]?>
</span>
<br><br>
<div id=main-loading-setting-optional class=L-font-14px>
<form id=setting-optional-form class>
<input type=hidden name=_token value="<?php echo $token?>">
<input type=hidden name="<?php echo md5('type-setting')?>" value="<?php echo md5('optional')?>">
<div class=L-d-flex>
<span><?php echo $setLangs->indications()['system_language']['status'][$indexLang]?>: </span>
<select name="<?php echo md5('lang')?>">
<?php foreach($langs as $lang):?>
<?php if($contents['lang']['value']==$lang['value']):?>
<option value="<?php echo $lang['value']?>" selected><?php echo $lang['prefix']?></option>
<?php else:?>
<option value="<?php echo $lang['value']?>"><?php echo $lang['prefix']?></option>
<?php endif;?>
<?php endforeach;?>
</select>
</div>
</form>
<br>
<button id=setting-optional-button class=L-b-style-1-s><?php echo $setLangs->indications()['update']['button_setting'][$indexLang]?></button>
</div>
</div>
</div>
<div class="L-width-100 L-o-auto L-p-fixed L-bottom" style="margin:0 0 -16px">
<p id=alert-bottom class="L-d-none L-n-style-1-danger L-t-a-center"></p>
</div>
</div>
</div>
<?php include($settings['admin-layouts'].'/footer.php');?>
<input id=index-dashboard type=hidden value="<?php echo $settings['route-dashboard'];?>">
<input id=index-lang-update type=hidden value="<?php echo $setLangs->indications($setLangs->contents()['setting']['no_plural'][$indexLang])['update']['process'][$indexLang]?>">
<script type=text/javascript>$(window).load(function(){var a=documentProperties();a.objectContent.mainLoading="#main-loading-setting-profile";a.objectContent.loadUrl=a.dinamicMainContentsUrl()+" #main-loading-setting-profile";a.objectContent.redirect="self-content";a.objectContent.formCreateTarget="#setting-profile-form";a.objectContent.indexUrl=a.dinamicEditContentUrl();a.objectContent.buttonCreateTarget="#setting-profile-button";a.objectContent.notice=a.indexLang.update;a.objectContent.alert="#alert-bottom";ajax(a.objectAjaxProperties());a.objectContent.mainLoading="#main-loading-setting-optional";a.objectContent.loadUrl=a.dinamicMainContentsUrl()+" #main-loading-setting-optional";a.objectContent.formCreateTarget="#setting-optional-form";a.objectContent.buttonCreateTarget="#setting-optional-button";ajax(a.objectAjaxProperties())});</script>
</body>
</html>
