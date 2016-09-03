<div class="L-t-a-center L-font-14px">
<div class="L-t-a-left L-o-auto">
<?php if(count($contents)>0):?>
<div class="L-g-f-roboto L-font-14px" style="">
<div class="L-d-flex">
<div class="L-b-whitesmoke L-width-100 L-d-flex" style="margin:2px 0">
<form class="index-id-form" style="padding:0 5px">
<input type="hidden" name="_token" value="<?= $token ?>">
<input class="checkbox-parent" type="checkbox">
</form>
<span style="margin-top:2.45px;margin-left:10px"><?= $langs->indications($langs->contents()['route']['plural'][$indexLang])['select_all']['status'][$indexLang] ?></span>
</div>
</div>
<?php foreach($contents as $content):?>
<div class="L-d-flex L-h-style-1">
<div class="L-b-whitesmoke L-width-100 L-d-flex" style="margin:2px 0">
<div class="L-f-left" style="padding:5px">
<form class="index-id-form">
<? if($content['system'] == 0): ?>
<input id="index-id-input-<?php echo $content['id']?>" class="checkbox-child" type="checkbox" name="<?php echo md5('route-'.$content['id'])?>" value="<?php echo md5($content['id'])?>">
<? endif; ?>
</form>
</div>
<div class="L-f-left L-padding-10px L-w-wrap L-width-100 L-l-height-1-5">
<div style="margin-bottom:10px">
<span><b><?= $langs->indications()['prefix']['status'][$indexLang] ?>:</b></span>
<span><?php echo $content['prefix']?></span>
@
<span><b><?= $langs->indications()['route']['status'][$indexLang] ?>:</b></span>
<span><?php echo $content['route']?></span>
@
<span><b><?= $langs->indications()['path']['status'][$indexLang] ?>:</b></span>
<span><?php echo $content['path']?></span>
@
<span><b><?= $langs->indications()['created_at']['status'][$indexLang] ?>:</b></span>
<span><?php echo $content['created_at']?></span>
@
<span><b><?= $langs->indications()['last_updated']['status'][$indexLang] ?>:</b></span>
<span><?php echo $content['updated_at']?></span>
@
<span><b><?= $langs->indications()['method']['status'][$indexLang] ?>:</b></span>
<span><?php echo $content['method']?></span>
<? if($content['system'] == 1): ?>
@
<span><b><?= $langs->indications()['system']['status'][$indexLang] ?></b></span>
<? endif; ?>
</div>
<div id="parent-index-task-<?php echo $content['id']?>">
<span id="task-edit-<?php echo $content['id']?>" class="task-edit L-c-pointer L-ts-style-1-edit" style="margin-right:2px"><?= $langs->indications()['edit']['button'][$indexLang] ?></span>
<? if($content['system'] == 0): ?>
<span id="task-notice-delete-<?php echo $content['id']?>" class="task-notice-delete L-ts-style-1-delete"><?= $langs->indications()['delete']['button'][$indexLang] ?></span>
<? endif;?>
</div>
<? if($content['system'] == 0): ?>
<div id="parent-index-task-notice-<?php echo $content['id']?>" class="L-d-none">
<span><?= $langs->indications($langs->contents()['route']['no_plural'][$indexLang])['delete']['question'][$indexLang] ?> </span>
<span id="task-delete-<?php echo $content['id']?>" class="task-delete L-c-pointer L-ts-style-1-delete" style="margin-right:2px"><?= $langs->indications()['yes']['status'][$indexLang] ?></span>
<span id="task-cancel-<?php echo $content['id']?>" class="task-cancel L-c-pointer L-ts-style-1-edit" style="margin-right:2px"><?= $langs->indications()['no']['status'][$indexLang] ?></span>
<form id="task-form-delete-<?php echo $content['id']?>">
<input type="hidden" name="_token" value="<?= $token ?>">
<input type="hidden" name="<?php echo md5('route-'.$content['id'])?>" value="<?php echo md5($content['id'])?>">
</form>
</div>
<? endif;?>
<div id="div-content-edit-<?php echo $content['id']?>" class="L-d-none" style="margin-top:10px">
<form class="div-form-save-<?php echo $content['id']?> div-form-status-<?php echo $content['id']?>">
<input type="hidden" name="_token" value="<?= $token ?>">
<input class="L-i-style-1-s" type="hidden" name="<?php echo md5('route-'.$content['id'])?>" value="<?php echo md5($content['id'])?>">
<? if($content['system'] == 0): ?>
<span><?= $langs->indications()['prefix']['status'][$indexLang] ?>:</span>
<div class="L-d-flex">
<input class="L-i-style-1-s" type="text" name="<?php echo md5('prefix')?>" value="<?php echo $content['prefix']?>" style="margin-bottom:2px;margin-top:0px;width:100%">
</div>
<? endif; ?>
<span><?= $langs->indications()['route']['status'][$indexLang] ?>:</span>
<div class="L-d-flex">
<input class="L-i-style-1-s" type="text" name="<?php echo md5('route')?>" value="<?php echo $content['route']?>" style="margin-top:0px;margin-bottom:2px;width:100%">
</div>
<? if($content['system'] == 0): ?>
<span><?= $langs->indications()['method']['status'][$indexLang] ?>:</span>
<div class="L-d-flex">
<div style="margin-top:0px;margin-bottom:2px;width:100%">
<? if($content['method'] == 'GET'): ?>
<input type=radio name="<?php echo md5('method')?>" value="GET" checked> GET
<? else: ?>
<input type=radio name="<?php echo md5('method')?>" value="GET"> GET
<? endif; ?>
<? if($content['method'] == 'POST'): ?>
<input type=radio name="<?php echo md5('method')?>" value="POST" checked> POST
<? else: ?>
<input type=radio name="<?php echo md5('method')?>" value="POST"> POST
<? endif; ?>
</div>
</div>
<? endif;?>
<? if($content['path'] != 'null'): ?>
<? if($content['system'] == 0): ?>
<span><?= $langs->indications()['path']['status'][$indexLang] ?>:</span>
<div class="L-d-flex">
<input class="L-i-style-1-s" type="text" name="<?php echo md5('path')?>" value="<?php echo $content['path']?>" style="margin-top:0px;margin-bottom:2px;width:100%">
</div>
<? endif;?>
<? endif; ?>
</form>
<div style="margin-top:13px"></div>
<span id="task-save-<?php echo $content['id']?>" class="task-save L-ts-style-1-save"><?= $langs->indications()['save']['button'][$indexLang] ?></span>
</div>
</div>
</div>
</div>
<?php endforeach;?>
<div class="L-d-flex">
<div class="L-b-whitesmoke L-width-100 L-d-flex" style="margin:2px 0">
<form class="index-id-form" style="padding:0 5px">
<input type="hidden" name="_token" value="<?= $token ?>">
<input class="checkbox-parent" type="checkbox">
</form>
<span style="margin-top:2.45px;margin-left:10px"><?= $langs->indications($langs->contents()['route']['plural'][$indexLang])['select_all']['status'][$indexLang] ?></span>
</div>
</div>
</div>
<?php else:?>
<div class="L-padding-20px">
<h1 class="L-g-f-lato L-c-blacksmooth"><?= $langs->indications($langs->contents()['route']['plural'][$indexLang])['no_contents_found']['status'][$indexLang] ?></h1>
</div>
<?php endif;?>
<div class="L-d-block" style="margin:20px 0">
<?php echo $pagination?>
</div>
</div>
</div>
