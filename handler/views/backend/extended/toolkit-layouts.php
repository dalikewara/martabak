<option> Choose:
<?php foreach($datas as $data): ?>
    <option class="toolkit-layout-items" value="<?php echo htmlspecialchars(file_get_contents($path->layouts_storage . '/' . $data->filename)); ?>" snippet="this is snippet model"> <?php echo $data->name; ?>
<?php endforeach; ?>
