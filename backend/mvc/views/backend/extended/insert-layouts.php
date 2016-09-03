<select id="select-insert-layout" name="select-route-prefix">
<option value=""><?= $langs->indications()['none']['status'][$indexLang] ?> (<?= $langs->indications()['default']['status'][$indexLang] ?>)</option>
<?php foreach($layoutsPrefix as $layout):?>
<option value="<?php echo htmlspecialchars($layout['content'])?>"><?php echo $layout['prefix']?></option>
<?php endforeach;?>
</select>
