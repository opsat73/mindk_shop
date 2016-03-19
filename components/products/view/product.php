<div class="container-fluid">
    <div class="row-fluid">
        <div class="col-lg-3"><?php
            echo $categories;
            ?></div>
        <div class="col-lg-9"><div class="jumbotron">
                <div class="row">
                    <H4><?php echo $product[product_name];?></H4>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <img src="/media/img/default.jpg" class="img-rounded" alt=<?php echo $product[product_name];?> width="300" height="300">
                    </div>
                    <div class="col-lg-1">
                    </div>
                    <div class="col-lg-7">
                        <div class="row">
                            <span><?php echo $product[product_description]?></span>
                        </div>
                        <div class ="row">
                            <span>Price: <?php echo $product[product_price]?> $</span>
                        </div>
                        <div class ="row">
                            <span>Available: <?php echo $product[product_count]?> items</span>
                        </div>

                    </div>
                </div>
            </div>
            <?php echo $random ?>
        </div>
    </div>
</div>

