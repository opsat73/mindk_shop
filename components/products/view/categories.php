<?php foreach($categories as $k => $v) :?>
<div class="row">
    <div class="col-lg-12">
        <ul class="list-group">
            <a class="list-group-item <?php echo ($v[child_count] != 0)?'navigation-parent':'navigation'; ?> categories" category_status ="closed"  shop_path="<?php echo $v[category_id];?>">
                <span class="badge <?php echo ($v[count] != 0)?'':'hidden'; ?>"><?php echo $v[count]; ?></span>
                <span id="category_glyph_<?php echo $v[category_id];?>" class="glyphicon <?php echo ($v[child_count] != 0)?'':'hidden'; ?>glyphicon-plus" aria-hidden="true"></span>
                <?php echo $v[category_name]; ?>
            </a>
        </ul>
    </div>
</div>
<div class="row three-content-row_<?php echo $v[category_id];?> hidden">
    <div class="col-lg-1">
    </div>
    <div class="col-lg-10 category_content_<?php echo $v[category_id];?>">
    </div>
</div>
<?php endforeach; ?>
<input hidden id="page" value="1"/>
<input hidden id="sort" value="ASC"/>
<input hidden id="category" value="0"/>
<script src="/media/vkorovay/js/categories.js"></script>
