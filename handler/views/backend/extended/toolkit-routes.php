<?php foreach($datas as $data): ?>
    <option class="toolkit-route-items" value="<?php echo htmlspecialchars(file_get_contents($path->layouts_storage . '/' . $data->filename)); ?>"> <?php echo $data->name; ?>
<?php endforeach; ?>
