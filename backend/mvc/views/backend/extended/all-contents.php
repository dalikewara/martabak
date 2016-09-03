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
<span style="margin-top:2.45px;margin-left:10px"><?= $langs->indications($langs->contents()['content']['plural'][$indexLang])['select_all']['status'][$indexLang] ?></span>
</div>
</div>
<?php foreach($contents as $content):?>
<div class="L-d-flex L-h-style-1">
<div class="L-b-whitesmoke L-width-100 L-d-flex" style="margin:2px 0">
<div class="L-f-left" style="padding:5px">
<form class="index-id-form">
<input id="index-id-input-<?php echo $content['id']?>" class="checkbox-child" type="checkbox" name="<?php echo md5('content-'.$content['id'])?>" value="<?php echo md5($content['id'])?>">
</form>
</div>
<div class="L-f-left L-padding-10px L-w-wrap L-width-100 L-l-height-1-5">
<div style="margin-bottom:10px">
<span><b><?= $langs->indications()['title']['status'][$indexLang] ?>:</b></span>
<span><?php echo $content['title']?></span>
@
<span><b><?= $langs->indications()['slug']['status'][$indexLang] ?>:</b></span>
<span><?php echo $content['slug']?></span>
@
<span><b><?= $langs->indications()['created_at']['status'][$indexLang] ?>:</b></span>
<span><?php echo $content['created_at']?></span>
@
<span><b><?= $langs->indications()['last_updated']['status'][$indexLang] ?>:</b></span>
<span><?php echo $content['updated_at']?></span>
@
<?php if($content['status']==1):?>
<span><b><?= $langs->indications()['publish']['status'][$indexLang] ?></b></span>
<?php elseif($content['status']==2):?>
<span><b><?= $langs->indications()['draft']['status'][$indexLang] ?></b></span>
<?php endif;?>
</div>
<div id="parent-index-task-<?php echo $content['id']?>">
<span id="task-edit-<?php echo $content['id']?>" class="task-edit L-c-pointer L-ts-style-1-edit" style="margin-right:2px"><?= $langs->indications()['quick_edit']['button'][$indexLang] ?></span>
<a class="L-a-style-1-r" href="<?php echo $edit.'/'.str_replace(' ','+',$content['title']).'/'.str_replace('/','+',$content['slug']);?>"><span class="L-c-pointer L-ts-style-1-edit" style="margin-right:2px"><?= $langs->indications()['edit']['button'][$indexLang] ?></span></a>
<span id="task-notice-delete-<?php echo $content['id']?>" class="task-notice-delete L-ts-style-1-delete"><?= $langs->indications()['delete']['button'][$indexLang] ?></span>
</div>
<div id="parent-index-task-notice-<?php echo $content['id']?>" class="L-d-none">
<span><?= $langs->indications($langs->contents()['content']['no_plural'][$indexLang])['delete']['question'][$indexLang] ?> </span>
<span id="task-delete-<?php echo $content['id']?>" class="task-delete L-c-pointer L-ts-style-1-delete" style="margin-right:2px"><?= $langs->indications()['yes']['status'][$indexLang] ?></span>
<span id="task-cancel-<?php echo $content['id']?>" class="task-cancel L-c-pointer L-ts-style-1-edit" style="margin-right:2px"><?= $langs->indications()['no']['status'][$indexLang] ?></span>
<form id="task-form-delete-<?php echo $content['id']?>">
<input type="hidden" name="_token" value="<?= $token ?>">
<input type="hidden" name="<?php echo md5('content-'.$content['id'])?>" value="<?php echo md5($content['id'])?>">
</form>
</div>
<div id="div-content-edit-<?php echo $content['id']?>" class="L-d-none" style="margin-top:10px">
<form class="div-form-save-<?php echo $content['id']?> div-form-status-<?php echo $content['id']?>">
<input type="hidden" name="_token" value="<?= $token ?>">
<input class="L-i-style-1-s" type="hidden" name="<?php echo md5('content-'.$content['id'])?>" value="<?php echo md5($content['id'])?>">
<span><?= $langs->indications()['title']['status'][$indexLang] ?>:</span>
<div class="L-d-flex">
<input class="L-i-style-1-s" type="text" name="<?php echo md5('title')?>" value="<?php echo $content['title']?>" style="margin-bottom:2px;margin-top:0px;width:100%">
</div>
<span><?= $langs->indications()['slug']['status'][$indexLang] ?>:</span>
<div class="L-d-flex">
<input class="L-i-style-1-s" type="text" name="<?php echo md5('slug')?>" value="<?php echo str_replace($content['route_prefix'], '', $content['slug'])?>" style="margin-top:0px;margin-bottom:15px;width:100%">
</div>
<input type="hidden" name="<?php echo md5('route-prefix')?>" value="<?php echo $content['route_prefix']?>">
</form>
<span id="task-save-<?php echo $content['id']?>" class="task-save L-ts-style-1-save"><?= $langs->indications()['save']['button'][$indexLang] ?></span>
<?php if($content['status']==1):?>
<span id="task-status-<?php echo $content['id']?>" class="task-status L-ts-style-1-cancel" value="draft"><?= $langs->indications()['draft']['button'][$indexLang] ?></span>
<form class="div-form-status-<?php echo $content['id']?>">
<input type="hidden" name="_token" value="<?= $token ?>">
<input class="L-i-style-1-s" type="hidden" name="<?php echo md5('status')?>" value="2">
</form>
<?php elseif($content['status']==2):?>
<span id="task-status-<?php echo $content['id']?>" class="task-status L-ts-style-1-cancel" value="publish"><?= $langs->indications()['publish']['button'][$indexLang] ?></span>
<form class="div-form-status-<?php echo $content['id']?>">
<input type="hidden" name="_token" value="<?= $token ?>">
<input class="L-i-style-1-s" type="hidden" name="<?php echo md5('status')?>" value="1">
</form>
<?php endif;?>
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
<span style="margin-top:2.45px;margin-left:10px"><?= $langs->indications($langs->contents()['content']['plural'][$indexLang])['select_all']['status'][$indexLang] ?></span>
</div>
</div>
</div>
<?php else:?>
<div class="L-padding-20px">
<h1 class="L-g-f-lato L-c-blacksmooth"><?= $langs->indications($langs->contents()['content']['plural'][$indexLang])['no_contents_found']['status'][$indexLang] ?></h1>
</div>
<?php endif;?>
<div class="L-d-block" style="margin:20px 0">
<?php echo $pagination?>
</div>
</div>
</div>
