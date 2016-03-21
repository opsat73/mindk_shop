<?php
foreach ($product_list as $k => $value): ?>
    <div class="jumbotron">
        <div class="row">
            <H4><a class="product_link" shop_path="<?php echo $value[product_id] ?>"><?php echo $value[product_name]; ?></a>
            </H4>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <img src="/media/img/<?php echo $value[picture_file_type].'/'.$value[picture_file_name];?>" class="img-rounded"
                     alt=<?php echo $value[product_name]; ?> width="300" height="300">
            </div>
            <div class="col-lg-1">
            </div>
            <div class="col-lg-7">
                <div class="row">
                    <span><?php echo $value[product_description] ?></span>
                </div>
                <div class="row">
                    <span>Price: <?php echo $value[product_price] ?> $</span>
                </div>
                <div class="row">
                    <span>Available: <?php echo $value[product_count] ?> items</span>
                </div>

            </div>
        </div>
    </div>
<?php endforeach; ?>
<div class="row">
    <div class="pagination">
        <?php $i = 0;
              $start = ($current_page - 3) <= 1? 1: $current_page - 3;
             if ($start != 1) : ?>
                 <li>
                     <a class="pagination_button" shop_path="<?php echo($start + $i-1)?>" aria-label="Previous">
                         <span aria-hidden="true">&laquo;</span>
                     </a>
                 </li>
        <?php endif;
        while ($start + $i <= $page_count && $i < 7): ?>
            <li class="<?php echo ($start + $i == $current_page)?'active':'' ?>"><a class="pagination_button" shop_path="<?php echo ($start + $i);?>"><?php echo $start + $i; ?></a>
            </li>
            <?php $i++;
        endwhile;
        if (($start + $i) <= $page_count):?>
            <li>
                <a class="pagination_button" shop_path="<?php echo ($start + $i);?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        <?php endif; ?>
    </div>
</div>
<script src="/media/vkorovay/js/product_list.js"></script>





