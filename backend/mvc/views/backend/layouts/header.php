<?php $headerLangs = isset($setLangs) ? $setLangs : (isset($langs) ? $langs : FALSE);$headerIndexLang = isset($indexLang) ? $indexLang : FALSE;?>
<style media="screen">@media only screen and (max-width:425px){#header-index-new-content{display:none}}</style>
<div id="header" class="L-top L-b-shadow-10px L-p-fixed L-width-100">
<div id="header-inner" class="L-width-100 L-b-whitesmoke L-c-blacksmooth">
<div class="L-d-flex" style="height:30px">
<div class="L-width-100">
<div class="L-f-left" style="margin-right:15px;margin-left:15px">
<a class="L-c-pointer L-a-style-1-r" href="/" title="Visit your main website/application.">
<img src="<?php echo $header['admin-assets'].'/icons/site.png';?>" style="width:30px;height:30px;margin-bottom:-4px" />
</a>
</div>
<div id="header-content" class="L-f-left L-c-pointer" style="margin-right:20px;margin-top:6px;display:block">
<span>&#9776</span>
<div id="header-content-popup" class="L-c-blacksmooth L-d-none L-b-white L-p-absolute L-font-14px L-g-f-lato" style="padding:10px 15px;margin-top:5px;z-index:10;margin-left:-15px">
<span><a class="L-a-style-1 L-c-blacksmooth" href="<?php echo $header['route-dashboard']?>"><?= $headerLangs->indications()['dashboard']['status'][$headerIndexLang] ?></a></span>
<br><br>
<span><a class="L-a-style-1 L-c-blacksmooth" href="<?php echo $header['request-home-builder']?>"><?= $headerLangs->indications()['home_builder']['status'][$headerIndexLang] ?></a></span>
<br><br>
<span><a class="L-a-style-1 L-c-blacksmooth" href="<?php echo $header['request-contents']?>"><?= $headerLangs->indications()['contents_storage']['status'][$headerIndexLang] ?></a></span>
<br><br>
<span><a class="L-a-style-1 L-c-blacksmooth" href="<?php echo $header['request-routes']?>"><?= $headerLangs->indications()['registered_routes']['status'][$headerIndexLang] ?></a></span>
<br><br>
<span><a class="L-a-style-1 L-c-blacksmooth" href="<?php echo $header['request-layouts']?>"><?= $headerLangs->indications()['layouts_management']['status'][$headerIndexLang] ?></a></span>
<br><br>
<span><a class="L-a-style-1 L-c-blacksmooth" href="<?php echo $header['request-settings']?>"><?= $headerLangs->indications()['system_settings']['status'][$headerIndexLang] ?></a></span>
<br><br>
<span><a class="L-a-style-1 L-c-blacksmooth" href="<?php echo $header['request-informations']?>"><?= $headerLangs->indications($headerLangs->contents()['information']['plural'][$headerIndexLang])['system_informations']['status'][$headerIndexLang] ?></a></span>
</div>
</div>
<div id="header-new-content" class="L-f-left" style="margin-right:20px;margin-top:5px">
<a class="L-a-style-1-r L-c-blacksmooth L-g-f-lato L-font-14px" href="<?php echo $header['request-create']?>">
<span>+</span> <span id="header-index-new-content" title="Create a new content."><?= $headerLangs->indications()['new_content']['status'][$headerIndexLang] ?></span>
</a>
</div>
</div>
<div class="L-width-100 L-t-a-right">
<div id="header-profile-picture" class="L-o-auto L-f-right" style="padding-top:5px">
<span class="L-g-f-lato L-font-14px L-c-pointer" style="padding-right:20px"><a class="L-a-style-1 L-c-blacksmooth" href="<?php echo $header['route-logout']?>"><?= $headerLangs->indications()['logout']['status'][$headerIndexLang] ?></a></span>
</div>
</div>
</div>
</div>
</div>
<script type="text/javascript">$(window).load(function(){hoverPopUp("#header-content","#header-content-popup")});</script>
