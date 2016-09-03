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
<span style="margin-top:2.45px;margin-left:10px"><?= $langs->indications($langs->contents()['layout']['plural'][$indexLang])['select_all']['status'][$indexLang] ?></span>
</div>
</div>
<?php foreach($contents as $content):?>
<div class="L-d-flex L-h-style-1">
<div class="L-b-whitesmoke L-width-100 L-d-flex" style="margin:2px 0">
<div class="L-f-left" style="padding:5px">
<form class="index-id-form">
<input id="index-id-input-<?php echo $content['id']?>" class="checkbox-child" type="checkbox" name="<?php echo md5('layout-'.$content['id'])?>" value="<?php echo md5($content['id'])?>">
</form>
</div>
<div class="L-f-left L-padding-10px L-w-wrap L-width-100 L-l-height-1-5">
<form class="div-form-save-<?php echo $content['id']?>">
<input type="hidden" name="_token" value="<?= $token ?>">
<input class="L-i-style-1-s" type="hidden" name="<?php echo md5('layout-'.$content['id'])?>" value="<?php echo md5($content['id'])?>">
<div class="L-d-flex">
<input class="L-i-style-1-s L-width-100" type="text" name="<?php echo md5('prefix')?>" value="<?php echo $content['prefix']?>" placeholder="<?= $langs->indications()['prefix']['placeholder'][$indexLang] ?>">
</div>
<div class="L-d-flex">
<textarea class="L-ta-style-1-s L-width-100" name="<?php echo md5('content')?>" style="height:150px" placeholder="<?= $langs->indications()['textarea']['layout_placeholder'][$indexLang] ?>"><?php echo htmlspecialchars($content['content'])?></textarea>
</div>
</form>
<div id="parent-index-task-<?php echo $content['id']?>">
<span id="task-save-<?php echo $content['id']?>" class="task-save L-c-pointer L-ts-style-1-save" style="margin-right:2px"><?= $langs->indications()['save']['button'][$indexLang] ?></span>
<span id="task-notice-delete-<?php echo $content['id']?>" class="task-notice-delete L-ts-style-1-delete"><?= $langs->indications()['delete']['button'][$indexLang] ?></span>
</div>
<div id="parent-index-task-notice-<?php echo $content['id']?>" class="L-d-none">
<span><?= $langs->indications($langs->contents()['layout']['no_plural'][$indexLang])['delete']['question'][$indexLang] ?> </span>
<span id="task-delete-<?php echo $content['id']?>" class="task-delete L-c-pointer L-ts-style-1-delete" style="margin-right:2px"><?= $langs->indications()['yes']['status'][$indexLang] ?></span>
<span id="task-cancel-<?php echo $content['id']?>" class="task-cancel L-c-pointer L-ts-style-1-edit" style="margin-right:2px"><?= $langs->indications()['no']['status'][$indexLang] ?></span>
<form id="task-form-delete-<?php echo $content['id']?>">
<input type="hidden" name="_token" value="<?= $token ?>">
<input type="hidden" name="<?php echo md5('layout-'.$content['id'])?>" value="<?php echo md5($content['id'])?>">
</form>
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
<span style="margin-top:2.45px;margin-left:10px"><?= $langs->indications($langs->contents()['layout']['plural'][$indexLang])['select_all']['status'][$indexLang] ?></span>
</div>
</div>
</div>
<?php else:?>
<div class="L-padding-20px">
<h1 class="L-g-f-lato L-c-blacksmooth"><?= $langs->indications($langs->contents()['layout']['plural'][$indexLang])['no_contents_found']['status'][$indexLang] ?></h1>
</div>
<?php endif;?>
<div class="L-d-block" style="margin:20px 0">
<?php echo $pagination?>
</div>
</div>
</div>
