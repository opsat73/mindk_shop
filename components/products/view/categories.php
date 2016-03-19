<?php foreach($categories as $k => $v) :?>
<ul class="list-group">
    <a class="list-group-item <?php echo ($v[category_id] == $current_category)?'active':''; ?>"  href="<?php echo '/'.$v[category_id].'/ASC/1'?>">
        <span class="badge"><?php echo $v[count]; ?></span>
        <?php echo $v[category_name]; ?>
    </a>
</ul>
<?php endforeach; ?>