<select id=select-route-prefix name="<?php echo md5('route-prefix')?>">
<option value=""><?= $langs->indications()['none']['status'][$indexLang] ?> (<?= $langs->indications()['default']['status'][$indexLang] ?>)</option>
<?php foreach($routesPrefix as $prefix):?>
<?php if($_GET['prefix'] == ltrim($prefix['route'], '/')):?>
<option value="<?php echo $prefix['route']?>" selected><?php echo $prefix['prefix']?></option>
<?php else:?>
<option value="<?php echo $prefix['route']?>"><?php echo $prefix['prefix']?></option>
<?php endif;?>
<?php endforeach;?>
</select>
