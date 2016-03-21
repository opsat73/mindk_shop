<?php foreach($categories as $k => $v) :?>
<ul class="list-group">
    <a class="list-group-item navigation categories"  shop_path="<?php echo $v[category_id];?>">
        <span class="badge"><?php echo $v[count]; ?></span>
        <?php echo $v[category_name]; ?>
    </a>
</ul>
<?php endforeach; ?>
<input hidden id="page" value="1"/>
<input hidden id="sort" value="ASC"/>
<input hidden id="category" value="0"/>
<script src="/media/vkorovay/js/categories.js"></script>
