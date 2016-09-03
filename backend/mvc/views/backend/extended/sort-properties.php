<div class="L-width-100 L-g-f-roboto L-font-14px L-c-whitesmoke L-b-blacksmooth L-h-style-1">
<div class="L-d-flex" style="padding:10px 20px">
<div class="L-o-auto L-width-100 L-d-block">
<div class="L-f-left L-d-block L-o-auto">
<div id="box-action-selected" class="L-c-disabled" style="opacity:0.5">
<label><?php echo $langs->indications()['action_selected']['status'][$indexLang]?>:</label>
<select id="spprop-action-select" class="" name="action-select">
<option id="action-delete" class="index-action" value="delete"><?php echo $langs->indications()['delete']['button'][$indexLang]?></option>
</select>
<span id="spprop-action-button" class="L-c-pointer L-b-style-1-s L-c-blacksmooth" style="padding:2px 5px"><?php echo $langs->indications()['process']['button'][$indexLang]?></span>
</div>
<br>
<div class="L-d-block">
<span id="spprop-total-selected" class="L-font-12px">0 <?php echo $langs->indications()['items_selected']['no_plural'][$indexLang]?></span>
<input id="spprop-index-total-selected" type="hidden" value="<?php echo $langs->indications()['items_selected']['no_plural'][$indexLang]?>">
<input id="spprop-index-plural-total-selected" type="hidden" value="<?php echo $langs->indications()['items_selected']['plural'][$indexLang]?>">
</div>
</div>
</div>
<div class="L-width-100 L-d-block">
<div class="L-f-right">
<form>
<input type="hidden" name="_token" value="<?= $token ?>">
<label id="spprop-sortby-target"><?php echo $langs->indications()['sort_by']['status'][$indexLang]?>: </label>
<?php if($type=='contents'):?>
<select>
<option class="spprop-status" value="1"><?php echo $langs->indications()['publish']['status'][$indexLang]?></option>
<option class="spprop-status" value="2"><?php echo $langs->indications()['draft']['status'][$indexLang]?></option>
</select>
<?php endif;?>
<select>
<option class="spprop-sortby" value="newer"><?php echo $langs->indications()['newer']['status'][$indexLang]?></option>
<option class="spprop-sortby" value="older"><?php echo $langs->indications()['older']['status'][$indexLang]?></option>
<?php if($type=='routes' OR $type=='layouts'):?>
<option class="spprop-sortby" value="title"><?php echo $langs->indications()['prefix']['status'][$indexLang]?></option>
<?php else:?>
<option class="spprop-sortby" value="title"><?php echo $langs->indications()['title']['status'][$indexLang]?></option>
<?php endif;?>
</select>
<select>
<option class="spprop-paginate" value="12">12</option>
<option class="spprop-paginate" value="24">24</option>
<option class="spprop-paginate" value="50">50</option>
<option class="spprop-paginate" value="100">100</option>
<option class="spprop-paginate" value="150">150</option>
<option class="spprop-paginate" value="250">250</option>
<option class="spprop-paginate" value="500">500</option>
</select>
</form>
</div>
<br><br>
<div class="L-f-right">
<input id="spprop-search-input" placeholder="<?php echo $langs->indications()['search']['placeholder'][$indexLang]?>" style="border:0;padding:4px 10px;border-radius:5px">
<span id="spprop-search-target" class="L-c-pointer L-b-style-1-s L-c-blacksmooth" style="padding:2px 5px"><?php echo $langs->indications()['search']['status'][$indexLang]?></span>
</div>
</div>
</div>
</div>
<form id="spprop-optional-form">
<input type="hidden" name="_token" value="<?= $token ?>">
</form>
