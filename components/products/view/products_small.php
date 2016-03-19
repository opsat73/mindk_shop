<div class="row-fluid">
    <?php
        foreach($random_list as $k =>$value): ?>
    <div class="col-lg-4">
            <div class="jumbotron">
                <div class="row">
                    <H4><a href="/product/<?php echo $value[product_id]?>"><?php echo $value[product_name];?></a></H4>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <img src="/media/img/default.jpg" class="img-rounded" alt=<?php echo $value[product_name];?> width="170" height="170">
                    </div>
                    </div>
                <div class="row">
                    <div class="col-lg-1">
                    </div>
                    <div class="col-lg-7">
                        <div class="row">
                            <span><?php echo $value[product_description]?></span>
                        </div>
                        <div class ="row">
                            <span>Price: <?php echo $value[product_price]?> $</span>
                        </div>
                        <div class ="row">
                            <span>Available: <?php echo $value[product_count]?> items</span>
                        </div>

                    </div>
                </div>
            </div>
            </div>
        <?php endforeach;?>
</div>